window.confirm_delete = function (delete_url, name) {
    let modal = document.getElementById('confirm_delete_modal');
    let task_name = document.getElementById('modal_task_name');
    modal.style.display = 'block';
    task_name.textContent = name;
    window.delete_task_url = delete_url;
}

window.delete_task = function () {
    window.location.replace(window.delete_task_url);
}

window.close_modal = function () {
    let modal = document.getElementById('confirm_delete_modal');
    modal.style.display = 'none';
}
