$(document).ready(function () {
    $(function () {
        $("#tabs").tabs({
            show: {
                effect: 'fade',
                duration: 'slow'
            }
        });
    });

    $("input[name='pensiontype']").click(function () {
        category = this.value;
        if (category == "employer") {
            $("input#contractcheck").prop("checked", true);
            $("input#contractcheck").prop("disabled", false);
            $("label#contractlabel").removeClass("grey");
        }
        if (category == "sacrifice") {
            $("input#contractcheck").prop("checked", false);
            $("input#contractcheck").prop("disabled", false);
            $("label#contractlabel").removeClass("grey");
        }
        if (category == "personal") {
            $("input#contractcheck").prop("checked", false);
            $("input#contractcheck").prop("disabled", true);
            $("label#contractlabel").addClass("grey");
        }
    });

    /*
    function () {
        $("input#contractcheck").removeAttr("disabled");
        $("input#contractcheck").attr("checked", "checked");
        $("label#contractlabel").removeAttr("class");
    }

    function () {
        $("input#contractcheck").attr("disabled", "disabled");
        $("label#contractlabel").attr("class", "grey");
    }
    */
});
