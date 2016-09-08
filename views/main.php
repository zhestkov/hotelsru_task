<div class="container">

    <h1>Simple comment project</h1>

    <div class="alert alert-danger" id="alert"></div>


    <div id="postForm">


        <p><input type="text" placeholder="From:" name="author" id="author1"></p>


                        <input type="hidden" placeholder="Post to #id comment" name="parentId" id="parentId1" value="0">

        <p><textarea rows="3" cols="32" placeholder="Enter your comment" name="content" id="content1"></textarea></p>
        <button class="btn btn-primary" id="postComment1" type="submit">Post comment</button>
    </div>



    <div id="comments">

        <?php displayTree(0); ?>
    </div>



</div>
