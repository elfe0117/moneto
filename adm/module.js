$(function() {
    $(".module_install").on("click", function() {
        var module = $(this).data("module");
        var name  = $(this).data("name");

        if(!confirm(name+" 모듈을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "./module_update.php",
            data: {
                "module": module
            },
            cache: false,
            async: false,
            success: function(data) {
                if(data) {
                    alert(data);
                    return false;
                }

                document.location.reload();
            }
        });
    });

    $(".module_preview").on("click", function() {
        var module = $(this).data("module");

        $("#module_detail").remove();

        $.ajax({
            type: "POST",
            url: "./module_detail.php",
            data: {
                "module": module
            },
            cache: false,
            async: false,
            success: function(data) {
                $("#module_list").after(data);
            }
        });
    });
});