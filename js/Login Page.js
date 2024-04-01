document.addEventListener("DOMContentLoaded", function() {
    const loginFormConfig = {
        "title": "Login into your account",
        "fields": [
            {
                "name": "username",
                "type": "text",
                "placeholder": "Username",
                "required": true
            },
            {
                "name": "password",
                "type": "password",
                "placeholder": "Password",
                "required": true
            }
        ],
        "links": [
            {
                "text": "Forgot password?",
                "href": "#",
                "class": "forget-password"
            }
        ],
        "buttons": [
            {
                "type": "submit",
                "text": "Login"
            }
        ],
        "createAccount": {
            "text": "Don't have an account?",
            "link": {
                "text": "Create new account",
                "href": "#",
                "class": "create-account-link"
            }
        }
    };

    function createFormElements(config) {
        const form = document.createElement("form");
        config.fields.forEach(field => {
            const input = document.createElement("input");
            Object.entries(field).forEach(([key, value]) => {
                if (key !== "class") {
                    input.setAttribute(key, value);
                } else {
                    input.classList.add(value);
                }
            });
            form.appendChild(input);
            form.appendChild(document.createElement("br"));
        });

        config.links.forEach(link => {
            const a = document.createElement("a");
            Object.entries(link).forEach(([key, value]) => {
                if (key !== "class") {
                    a.setAttribute(key, value);
                } else {
                    a.classList.add(value);
                }
            });
            a.appendChild(document.createTextNode(link.text));
            form.appendChild(a);
            form.appendChild(document.createElement("br"));
        });

        config.buttons.forEach(button => {
            const btn = document.createElement("button");
            Object.entries(button).forEach(([key, value]) => {
                if (key !== "class") {
                    btn.setAttribute(key, value);
                } else {
                    btn.classList.add(value);
                }
            });
            btn.appendChild(document.createTextNode(button.text));
            form.appendChild(btn);
        });

        const createAccountDiv = document.createElement("div");
        const p = document.createElement("p");
        const createAccountLink = document.createElement("a");
        Object.entries(config.createAccount.link).forEach(([key, value]) => {
            if (key !== "class") {
                createAccountLink.setAttribute(key, value);
            } else {
                createAccountLink.classList.add(value);
            }
        });
        createAccountLink.appendChild(document.createTextNode(config.createAccount.link.text));
        p.appendChild(document.createTextNode(config.createAccount.text));
        p.appendChild(createAccountLink);
        createAccountDiv.appendChild(p);
        form.appendChild(createAccountDiv);

        return form;
    }

    function initLoginPage() {
        const loginBox = document.querySelector(".login-box");
        const form = createFormElements(loginFormConfig);
        loginBox.appendChild(form);
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const requestData = {};
        formData.forEach((value, key) => {
            requestData[key] = value;
        });

        
        const url = './json/Login Page.json';
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        };

        fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    initLoginPage();

    const loginForm = document.querySelector('form');
    loginForm.addEventListener('submit', handleFormSubmit);
});

