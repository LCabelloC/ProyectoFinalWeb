function openButton(id, project_name, photo_url) {
    document.getElementById('blur-color-1').style.display = 'flex';
    document.getElementsByTagName('body')[0].style.overflow = 'hidden';

    document.getElementById('project-id').value = id;
    document.getElementById('title-project').textContent = project_name;

    const img = document.getElementById('project-img');
    img.setAttribute('src', photo_url);
    img.setAttribute('alt', project_name);
}

function closeButton() {
    document.getElementById('blur-color-1').style.display = 'none';
    document.getElementsByTagName('body')[0].style.overflow = 'auto';

    document.getElementById('project-id').value = '';
    document.getElementById('title-project').textContent = '';
    document.getElementById('project-img').setAttribute('src', '');
    document.getElementById('project-img').setAttribute('alt', '');
}

function createProject() {
    document.getElementById('blur-color-2').style.display = 'flex';
    document.getElementsByTagName('body')[0].style.overflow = 'hidden';


}

function closeCreateProject() {
    document.getElementById('blur-color-2').style.display = 'none';
    document.getElementsByTagName('body')[0].style.overflow = 'auto';

    document.getElementById('project-name').value = '';
    document.getElementById('project-description').value = '';
    document.getElementById('project-image').value = '';
    document.getElementById('image-preview').setAttribute('src', '');
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('project-amount').value = '';

}

function previewImage() {
    var input = document.getElementById('project-image');
    var preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}