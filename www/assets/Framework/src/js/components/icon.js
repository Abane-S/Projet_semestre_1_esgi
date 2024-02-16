document.addEventListener('DOMContentLoaded', function() {
    var labelElement = document.getElementById('menu_icon_label');
    var labelContent = labelElement.textContent;
    var selectedOption = document.getElementById('menu_icon_select').value;
    labelElement.innerHTML = labelContent + "<i class='" + selectedOption + "'></i>";

    document.getElementById('menu_icon_select').addEventListener('change', function() {
        var selectedOption = this.value;
        labelElement.innerHTML = labelContent + "<i class='" + selectedOption + "'></i>";
    });
});
