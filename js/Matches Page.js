document.addEventListener("DOMContentLoaded", function() {
    function fetchData(url) {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    const apiUrl = "./json/Matches Page.json";

    function populateHeaderData(headerData) {
        const miniPreHeaderLinks = document.querySelector(".mini-pre-header p a");
        miniPreHeaderLinks.textContent = headerData.miniPreHeader.links[0].text;
        miniPreHeaderLinks.setAttribute("href", headerData.miniPreHeader.links[0].href);

        const bigPreHeaderLogo = document.querySelector(".big-pre-header img");
        bigPreHeaderLogo.setAttribute("src", headerData.bigPreHeader.logoSrc);

        const mainMenuItems = document.querySelectorAll(".big-pre-header .main-menu li a");
        headerData.bigPreHeader.menuItems.forEach((menuItem, index) => {
            mainMenuItems[index].textContent = menuItem.text;
            mainMenuItems[index].setAttribute("href", menuItem.href);
        });
    }
    function populateFooterData(footerData) {
        const contactLinks = document.querySelectorAll("footer .contact a");
        footerData.contact.links.forEach((link, index) => {
            contactLinks[index].textContent = link.text;
            contactLinks[index].setAttribute("href", link.href);
        });
        const quickLinks = document.querySelectorAll("footer .quickLinks a");
        footerData.quickLinks.links.forEach((link, index) => {
            quickLinks[index].textContent = link.text;
            quickLinks[index].setAttribute("href", link.href);
        });
    }
    fetchData(apiUrl)
        .then(data => {
            populateHeaderData(data.header);
            populateFooterData(data.footer);
        });
});
