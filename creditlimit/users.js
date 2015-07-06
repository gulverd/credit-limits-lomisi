function setUpdateAction() {
	document.frmUser.action = "edit_user.php";
	document.frmUser.submit();
}
function setUpdateAction2() {
	document.frmUser.action = "edit_user2.php";
	document.frmUser.submit();
}
function setUpdateAction3() {
	document.frmUser.action = "edit_user3.php";
	document.frmUser.submit();
}
function setUpdateAction7() {
	document.frmUser.action = "edit_user7.php";
	document.frmUser.submit();
}
function setRemoveAction() {
	document.frmUser.action = "edit_user4.php";
	document.frmUser.submit();
}
function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmUser.action = "delete_user.php";
document.frmUser.submit();
}
}