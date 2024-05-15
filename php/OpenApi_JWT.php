<?php
require_once 'jwt.php';


require_once 'php/CRUD_operations/teams.php';
require_once 'php/CRUD_operations/events.php';
require_once 'php/CRUD_operations/groups.php';
require_once 'php/CRUD_operations/matches.php';
require_once 'php/CRUD_operations/news.php';


function verifyAccess() {
    $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    $jwt = new JWT();

    if (!$jwt->validateToken($token)) {
        http_response_code(401);
        echo json_encode(array("message" => "Neovlašten pristup."));
        exit();
    }
}

$request_method = $_SERVER['REQUEST_METHOD'];

verifyAccess();

include_once 'php/db_connect.php';

require_once 'php/CRUD operations/teams_page_crud.php';
require_once 'php/controllers/event_curd.php';
require_once 'php/controllers/group_page_crud.php';
require_once 'php/controllers/matches_page_crud.php';
require_once 'php/controllers/news_page_crud.php';

$teams_page_crud = new TeamsController($pdo);
if ($request_method == 'GET') {
    $teams_page_crud->getAllTeams();
} elseif ($request_method == 'POST') {
    $teams_page_crud->createTeam();
} elseif ($request_method == 'PUT') {
    $teams_page_crud->updateTeam();
} elseif ($request_method == 'DELETE') {
    $teams_page_crud->deleteTeam();
}

$events_crud = new EventsCrud($pdo);
if ($request_method == 'GET') {
    $events_crud->getAllEvents();
} elseif ($request_method == 'POST') {
    $events_crud->createEvent();
} elseif ($request_method == 'PUT') {
    $events_crud->updateEvent();
} elseif ($request_method == 'DELETE') {
    $events_crud ->deleteEvent();
}

$group_page_crud = new GroupsCrud($pdo);
if ($request_method == 'GET') {
    $group_page_crud->getAllGroups();
} elseif ($request_method == 'POST') {
    $$group_page_crud->createGroup();
} elseif ($request_method == 'PUT') {
    $group_page_crud->updateGroup();
} elseif ($request_method == 'DELETE') {
    $group_page_crud->deleteGroup();
}

$matches_page_crud = new MatchesCrud($pdo);
if ($request_method == 'GET') {
    $matches_page_crud->getAllMatches();
} elseif ($request_method == 'POST') {
    $matches_page_crud->createMatch();
} elseif ($request_method == 'PUT') {
    $matches_page_crud->updateMatch();
} elseif ($request_method == 'DELETE') {
    $matches_page_crud->deleteMatch();
}


$news_page_crud = new NewsCrud($pdo);
if ($request_method == 'GET') {
    $news_page_crud->getAllNews();
} elseif ($request_method == 'POST') {
    $news_page_crud->createNews();
} elseif ($request_method == 'PUT') {
    $news_page_crud->updateNews();
} elseif ($request_method == 'DELETE') {
    $news_page_crud->deleteNews();
}


$swaggerSpec = array(
    "openapi" => "3.0.0",
    "info" => array(
        "title" => "UEFA Euro API",
        "version" => "1.0.0",
        "description" => "API specification for my  UEFA Euro app."
    ),
    
    "paths" => array(
        "/teams" => array(
            "get" => array(
                "summary" => "GETTING all teams .",
                "responses" => array(
                    "200" => array(
                        "description" => "Succesfull."
                    ),
                    "401" => array(
                        "description" => "Error."
                    )
                )
            ),
            "post" => array(
                "summary" => "Creation of new team.",
                
            )
        )
    )
);

header('Content-Type: application/json');
echo json_encode($swaggerSpec, JSON_PRETTY_PRINT);