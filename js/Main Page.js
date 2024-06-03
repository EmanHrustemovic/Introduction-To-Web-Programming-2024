$(document).ready(function() {
    $.ajax({
        url: "./json/Main Page.json",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#miniPreHeaderLink').text(data.header.miniPreHeader.links[0].text).attr('href', data.header.miniPreHeader.links[0].href);

            var miniMenu = '';
            $.each(data.header.bigPreHeader.menuItems, function(index, menuItem) {
                miniMenu += '<li><a href="' + menuItem.href + '">' + menuItem.text + '</a></li>';
            });
            $('#miniMenu').html(miniMenu);

            $('#logoImg').attr('src', data.header.bigPreHeader.logoSrc);

            var mainMenu = '';
            $.each(data.header.bigPreHeader.menuItems, function(index, menuItem) {
                mainMenu += '<li><a href="' + menuItem.href + '">' + menuItem.text + '</a></li>';
            });
            $('#mainMenu').html(mainMenu);

            $('#newsTitle').text(data.latestNews.title);
            $('#newsContent').html(data.latestNews.content);
            $('#newsCta').text(data.latestNews.cta.text).attr('href', data.latestNews.cta.href);

            var contactLinks = '';
            $.each(data.footer.contact.links, function(index, link) {
                contactLinks += '<li><a href="' + link.href + '">' + link.text + '</a></li>';
            });
            $('#contactLinks').html(contactLinks);

            var productLinks = '';
            $.each(data.footer.products, function(index, product) {
                productLinks += '<li><a href="' + product.href + '">' + product.text + '</a></li>';
            });
            $('#productLinks').html(productLinks);

            var footerContacts = '';
            $.each(data.footer.contacts.links, function(index, contact) {
                footerContacts += '<li><a href="' + contact.href + '">' + contact.text + '</a></li>';
            });
            $('#footerContacts').html(footerContacts);

            var supportLinks = '';
            $.each(data.footer.support.links, function(index, link) {
                supportLinks += '<li><a href="' + link.href + '">' + link.text + '</a></li>';
            });
            $('#supportLinks').html(supportLinks);

            var socialMediaLinks = '';
            $.each(data.footer.socialMedia.links, function(index, link) {
                socialMediaLinks += '<li><a href="' + link.href + '"><i class="' + link.icon + '"></i></a></li>';
            });
            $('#socialMediaLinks').html(socialMediaLinks);

            $('#footerText').text(data.footer.copyright.text);

            var quickLinks = '';
            $.each(data.footer.quickLinks.links, function(index, link) {
                quickLinks += '<li><a href="' + link.href + '">' + link.text + '</a></li>';
            });
            $('#quickLinks').html(quickLinks);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error loading JSON:', textStatus, errorThrown);
        }
    });
});
