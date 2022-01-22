$(function () {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-aboutus").addClass('nav-link active');

    Fancybox.bind("#aboutus_gallery a", {
        groupAll: true, // Group all items
        on: {
            ready: (fancybox) => {
                console.log(`fancybox #${fancybox.id} is ready!`);
            }
        }
    });
});
