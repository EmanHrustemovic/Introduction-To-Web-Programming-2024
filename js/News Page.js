document.addEventListener("DOMContentLoaded", function() {
    function addMiniPreHeaderLinks(links) {
        var miniPreHeader = document.querySelector(".mini-pre-header");
        var miniMenu = miniPreHeader.querySelector(".mini-menu");

        links.forEach(function(link) {
            var li = document.createElement("li");
            var a = document.createElement("a");
            a.textContent = link.text;
            a.href = link.href;
            li.appendChild(a);
            miniMenu.appendChild(li);
        });
    }

    function addBigPreHeaderNavigation(menuItems) {
        var bigPreHeader = document.querySelector(".big-pre-header");
        var mainMenu = bigPreHeader.querySelector(".main-menu");

        menuItems.forEach(function(item) {
            var li = document.createElement("li");
            var a = document.createElement("a");
            a.textContent = item.text;
            a.href = item.href;
            li.appendChild(a);
            mainMenu.appendChild(li);
        });
    }

    function addNews(newsItems) {
        var newsSection = document.querySelector(".news-section");

        newsItems.forEach(function(item, index) {
            var col = document.createElement("div");
            col.classList.add("col-md-4");
            var div = document.createElement("div");
            div.classList.add("news-item");
            var h1 = document.createElement("h1");
            h1.textContent = item.title;
            var p = document.createElement("p");
            p.textContent = item.content;
            var a = document.createElement("a");
            a.textContent = item.cta.text;
            a.href = item.cta.href;
            a.classList.add(item.cta.class);
            div.appendChild(h1);
            div.appendChild(p);
            div.appendChild(a);
            col.appendChild(div);
            newsSection.appendChild(col);
        });
    }

    function initializePage(data) {
        addMiniPreHeaderLinks(data.header.miniPreHeader.links);
        addBigPreHeaderNavigation(data.header.bigPreHeader.menuItems);
        addNews(data.newsSection.newsItems);
    }

    var apiUrl = "./json/News Page.json";

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => initializePage(data))
        .catch(error => console.error("Error fetching data from API:", error));
});
