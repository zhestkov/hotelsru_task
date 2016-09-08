<div class="footer">


    <!-- Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Write comment</h4>
                </div>
                <div class="modal-body">

                    <div id="postForm">
                        <p><input type="text" placeholder="From:" name="author" id="author"></p>

                        <input type="text" placeholder="Post to #id comment" name="parentId" id="parentId">

                        <p><textarea rows="3" cols="32" placeholder="Enter your comment" name="content" id="content"></textarea></p>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="postComment" data-dismiss="modal" type="submit">Post comment</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        &copy; Andrey Zhestkov
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>




<script>
    var maxId = 1;
    var error = "";

    // $(".commentButton").click(function() {
    $("#commentModal").on('show.bs.modal', function(e) {
        var comment = $(e.relatedTarget).parent().parent().parent();
        console.log(comment);
        var id = comment.attr('data-commentId');
        //alert(id);
        
        //console.log(comment);
        $("#parentId").val(id);
    });


    //$("#parentId").val(id);
    // });

    function buildTree() {
        $(".comment").each(function(index) {
            var level = $(this).attr('data-level');
            var shift = 80 * level;
            $(this).css("position", "relative");
            $(this).css("left", shift + "px");
            //alert("test");
        });
    }

    function refreshAfterUpdate() {
        var check = $.ajax({
            type: "POST",
            url: "functions.php?function=maxId",
            data: "currentMax=" + maxId,
            success: function(result) {
                //alert(result);
                var server_maxId = parseInt(result);
                //if (maxId != server_maxId) {
                maxId = server_maxId;
                $('#comments').load(document.URL + ' .comment', buildTree);

                //}
            }
        });
        check.done(function(data) {
            setTimeout(refreshAfterUpdate, 3000);
        });
        check.fail(function() {
            alert("Something wrong with ajax auto refresh every N seconds");
        })
    }

    $(window).onload = buildTree();
    $(window).onload = refreshAfterUpdate();


    $(document).on('click', '.deleteButton', function() {
        var id = $(this).attr('data-commentId');
        //alert(1);
        //console.log(id);
        $.ajax({
            type: "POST",
            url: "actions.php?action=delete_coment",
            data: "id=" + id,
            success: function(result) {
                if (result == "OK") {
                    //alert(result);
                    $('#comments').load(document.URL + ' .comment', buildTree);
                }
                else {
                    alert(result);
                    error += result;

                    if (error != "") {
                        error = "<ul>" + error + "</ul>";
                        $("#alert").html(error);
                        $("#alert").show();
                    } else {
                        error = "";
                        $("#alert").hide();

                    }

                }
            }
            
        });
    });



    $(document).on('click', "#postComment", function() {


        //alert("test");
        //return false;
        //var pid = $("#parentId").val();
        //alert(pid);
        if ($("#author").val() == "")
            error += "<li>Author field is required.</li>";
        if ($("#content").val() == "")
            error += "<li>Comment field is required.</li>";
        if ($("#parentId").val() == "")
            error += "<li>parentID field is required.</li>";

        if (error != "") {
            error = "<p><strong>There are some error(s):</strong></p><ul>" + error + "</ul>";
            $("#alert").html(error);
            $("#alert").show();
        } else {
            error = "";
            $("#alert").hide();


            $.ajax({
                type: "POST",
                url: "actions.php?action=post_comment",
                data: "author=" + $("#author").val() + "&content=" + $("#content").val() + "&parentId=" + $("#parentId").val(),
                success: function(result) {
                    //alert(result);

                    $('#comments').load(document.URL + ' .comment', buildTree);


                }

            });
        }

    });
    
    
    
    $(document).on('click', "#postComment1", function() {


        
        //return false;
        if ($("#author1").val() == "")
            error += "<li>Author1 field is required.</li>";
        if ($("#content1").val() == "")
            error += "<li>Comment field is required.</li>";
        if ($("#parentId1").val() == "")
            error += "<li>parentID1 field is required.</li>";

        if (error != "") {
            error = "<p><strong>There are some error(s):</strong></p><ul>" + error + "</ul>";
            $("#alert").html(error);
            $("#alert").show();
        } else {
            error = "";
            $("#alert").hide();


            $.ajax({
                type: "POST",
                url: "actions.php?action=post_comment",
                data: "author=" + $("#author1").val() + "&content=" + $("#content1").val() + "&parentId=" + $("#parentId1").val(),
                success: function(result) {
                    //alert(result);

                    $('#comments').load(document.URL + ' .comment', buildTree);


                }

            });
        }

    });
    

    //window.onload = buildTree();
    //buildTree();

</script>

</body>

</html>
