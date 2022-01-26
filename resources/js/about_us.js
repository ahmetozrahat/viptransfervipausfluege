import Viewer from 'viewerjs';

$(function () {
    $("#nav-link-home").attr('class', 'nav-link');
    $("#nav-link-aboutus").addClass('nav-link active');

    // View a list of images.
    // Note: All images within the container will be found by calling `element.querySelectorAll('img')`.
    const gallery = new Viewer(document.getElementById('aboutus_gallery'));
});
