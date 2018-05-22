$(function () {
    document.getElementById('sel1_s').value = document.getElementById('msg_s').value;
});

function OnSelectionChange(select) {
    document.getElementById('msg_s').value = select.value;
}