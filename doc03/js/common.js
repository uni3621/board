$(document).ready(function(){
	$(".dat_delete_pw_bt").click(function(){
		var obj = $(this).closest(".dap_lo").find(".dat_delete_pw");
		obj.dialog({
			modal:true,
			width:400,
			title:"댓글 삭제확인"});
	});

	$(".dat_delete_bt").click(function(){
		var obj = $(this).closest(".dap_lo").find(".rep_delete");
		obj.dialog({
			modal:true,
			width:400,
			title:"댓글 삭제확인"});
	});
});