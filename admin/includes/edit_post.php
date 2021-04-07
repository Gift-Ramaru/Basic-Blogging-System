<?php
if(isset($_GET['edit_post']) && $_GET['edit_post'] !== "") {
    $editId = $_GET['edit_post'];
    $query = mysqli_query($connection, "SELECT * FROM posts WHERE post_id=$editId");
    if(mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_array($query);
        $title = $result['post_title'];
        $author = $result['post_author'];
        $content = $result['post_content'];
        $image = $result['post_image'];
        $tag = $result['post_tags'];
        $post_status = $result['post_status'];
        $post_cat = $result['post_category'];
    }else {
        redirect('posts.php?source=');
    }
    if(isset($_POST['update'])) {
        update_post($editId);
    }
}else {
    redirect('posts.php?source=');
}
 $sql = "SELECT * FROM categories";
 $res = mysqli_query($connection, $sql);

 ?>

<div class="container">
<div class="row">
  <h2>Edit Post</h2>
  <div class="col-sm-12 col-lg-7">
    <form action="posts.php?source=edit&edit_post=<?php echo $editId; ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Post title</label>
        <input type="text" name="title" placeholder="Post Title" class="form-control" value="<?php echo $title; ?>">
      </div>
      <div class="form-group">
        <label for="">Post Author</label>
        <input type="text" value="<?php echo $_SESSION['username'];?>" name="author" placeholder="Post Author" class="form-control" value="<?php echo $author; ?>">
      </div>
      <div class="form-group">
        <label for="">Post Category</label>
      <select class="form-control" name="category">
        <?php
        echo "<option value='$post_cat'><b>$post_cat</b></option>";
          while ($row = mysqli_fetch_array($res)) {
            $cat_title = $row['cat_title'];
            echo "<option value='$cat_title'>$cat_title</option>";
          }
         ?>

      </select>
      </div>
      
      <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="content" rows="8" cols="80" class="form-control"><?php echo $title; ?></textarea>
      </div>
      <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" name="tags" placeholder="Seperate tags with a comma (,)" class="form-control" value="<?php echo $tag; ?>">
      </div>
      <div class="form-group">
        <label for="">Post Status</label>
      <select class="form-control" name="status">
      <?php
        if($post_status == 'draft') {
            echo "<option value='draft'>Draft</option>
        <option value='published'>Published</option>";
        }else {
            echo "<option value='published'>Published</option>
            <option value='draft'>Draft</option>";
        }
      ?>
        
      </select>
      </div>
      <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" name="post_image"  class="form-control">
        <label for="">Do not tamper with!</label>
        <input type="text" name='placeholderImage' value='<?php echo $image; ?>' class="form-control">
        <br>
        <img src="images/<?php echo $image; ?>" width="250px" alt="">
      </div>
      <div class="form-group">
        <input type="submit" name="update" value="Update Post"  class="btn btn-success">
      </div>
    </form>
  </div>
</div>

</div>
