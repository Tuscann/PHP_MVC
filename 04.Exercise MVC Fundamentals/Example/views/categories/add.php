<?php /** @var \SoftUni\Core\ViewInterface $this */ ;?>
<div class="container">
    <div class="well bs-component">
        <form class="form-horizontal" method="post" action="<?=$this->url("categories", "addPost");?>">
            <fieldset>
                <legend>Create Category</legend>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="name" id="name" placeholder="Category name..." type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button name="edit" type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>