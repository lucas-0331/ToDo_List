window.submit_form_new_task = function() {
    let forms = document.getElementById('new_task_form');
    forms.submit();
    console.log(forms);
    return false;
}
