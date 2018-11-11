
$(document).ready(function () {
    $("#moduleForm").submit(function (evt) {
       //Validation for adding a module
        var moduleName = $("#moduleName").val();
        var isValid = true;
        var moduleCredits = $("#moduleCredits").val();

        if (moduleName == "")
        {
            $("#noName").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noName").animate({fontSize: '1.3em'}, "slow");
            $("#noName").animate({fontSize: '1em'}, "slow");
        } else {
            $("#moduleName").next().text("");
        }

        if (moduleCredits == "")
        {
            $("#noCredits").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noCredits").animate({fontSize: '1.3em'}, "slow");
            $("#noCredits").animate({fontSize: '1em'}, "slow");
        } else {
            $("#moduleCredits").next().text("");
        }

        if (isValid == true)
        {
            $("#moduleForm").submit();
        }
        evt.preventDefault();
    });

    //Student form validation
    $("#addStudentForm").submit(function (evt) {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var isValid = true;

        if (firstName == "")
        {
            $("#noName").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noName").animate({fontSize: '1.3em'}, "slow");
            $("#noName").animate({fontSize: '1em'}, "slow");
        } else {
            $("#firstName").next().text("");
        }

        if (lastName == "")
        {
            $("#noLastName").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noLastName").animate({fontSize: '1.3em'}, "slow");
            $("#noLastName").animate({fontSize: '1em'}, "slow");
        } else {
            $("#lastName").next().text("");
        }

        if (email == "")
        {
            $("#noEmail").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noEmail").animate({fontSize: '1.3em'}, "slow");
            $("#noEmail").animate({fontSize: '1em'}, "slow");
        } else {
            $("#email").next().text("");
        }

        if (isValid == true)
        {
            $("#addStudentForm").submit();
        }
        evt.preventDefault();
    });

    //Assigning student to module form validation
    $("#addStudentModuleForm").submit(function (evt) {
        var studentId = $("#studentId").val();
        var grade = $("#grade").val();
        var isValid = true;

        if (studentId == "")
        {
            $("#noId").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noId").animate({fontSize: '1.3em'}, "slow");
            $("#noId").animate({fontSize: '1em'}, "slow");
        } else {
            $("#noId").text("");
        }

        if (grade == "")
        {
            $("#noGrade").css("color", "red").text("You must enter a value");
            isValid = false;
            $("#noGrade").animate({fontSize: '1.3em'}, "slow");
            $("#noGrade").animate({fontSize: '1em'}, "slow");
        } else {
            $("#noGrade").text("");
        }

        if (isValid == true)
        {
            $("#addStudentModuleForm").submit();
        }

        evt.preventDefault();
    });

    //Maintaining Scroll Position
    $(window).scroll(function () {
        sessionStorage.scrollTop = $(this).scrollTop();
    });

    if (sessionStorage.scrollTop != "undefined") {
        $(window).scrollTop(sessionStorage.scrollTop);
    };
});