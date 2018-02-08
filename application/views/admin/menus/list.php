<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Menus</li>
            </ol>

            <?php
            if($this->session->flashdata('flash_message'))
            {
            ?>
                <div class="alert alert-success">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_message'); ?></p>
                </div>
            <?php
            }

            if($this->session->flashdata('flash_error'))
            {
            ?>
                <div class="alert alert-danger">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_error'); ?></p>
                </div>
            <?php
            }
            ?>

            <div class="content_title">
                <h2><small>Menus</small></h2>
            </div>
            <div class="frntnd_mnubg">
                <div class="col-md-6 remove_menu_from_list">
                    <form>
                        <input type="hidden" name="category_remove" value="1">
                        <button class="btn btn-danger" type="button" name="remove" onclick="add_rem_menus('remove', this);">Remove From Menu</button>
                        <ul>
                        <?php
                        $menus = get_settings('frontend_menu');
                        if (sizeof($menus) > 0)
                        {
                            foreach ($menus as $keyM => $valueM)
                            {
                        ?>
                            <li data-slug="<?php echo $valueM['slug']; ?>" data-name="<?php echo $valueM['name']; ?>" data-id="<?php echo $valueM['id']; ?>">
                                
                                <input type="checkbox" class="menu-cat" name="category_remove" value="<?php echo $valueM['id']; ?>" id="<?php echo $valueM['id']; ?>">
                                <label for="<?php echo $valueM['id']; ?>"><span><?php echo $keyM+1; ?>.&nbsp;</span><?php echo $valueM['name']; ?></label>
                            </li>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                            <li><i>-- No Menus Added yet. --</i></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </form>
                </div>

                <div class="col-md-6 box_shadow_div add_menu_in_list">
                    <form>
                        <input type="hidden" name="category_add" value="1">
                        <button class="btn btn-success" type="button" name="add" onclick="add_rem_menus('add', this);">Add To Menu</button>
                        <ul>
                        <?php
                        if (sizeof($all_records) > 0)
                        {
                            foreach ($all_records as $keyAR => $valueAR)
                            {
                        ?>
                                <li data-slug="<?php echo $valueAR['store_category_slug']; ?>" data-name="<?php echo $valueAR['store_category_name']; ?>" data-id="<?php echo $valueAR['id']; ?>" >
                                    
                                    <input type="checkbox" class="menu-cat" id="<?php echo $valueAR['id']; ?>" name="add_category" value="<?php echo $valueAR['id']; ?>">
                                    <label for="<?php echo $valueAR['id']; ?>"><span><?php echo $keyAR+1; ?>.&nbsp;</span><?php echo $valueAR['store_category_name']; ?></label>
                                </li>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                            <li><i>-- No categories added yet. --</i></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function add_rem_menus(action, ele)
    {
        if (confirm("Are you sure?"))
        {
            var cat_menus = [];
            if (action == 'add')
            {
                var li_eles = $(ele).siblings('ul').find(".menu-cat:checked");
            }
            else
            {
                var li_eles = $(ele).siblings('ul').find(".menu-cat").not(':checked');
            }

            li_eles.each(function() 
            {
                var cat = {'slug' : $(this).parents('li').attr('data-slug'),
                            'name' : $(this).parents('li').attr('data-name'),
                            'id' : $(this).parents('li').attr('data-id')};

                cat_menus.push(cat);
            });

            if (cat_menus.length > 0)
            {
                $.ajax({
                    url : BASEURL + ADMIN_PREFIX + '/save-settings',
                    data : {'frontend_menu' : cat_menus, 'setting_type' : 'frontend_menus', 'action': action},
                    type: 'POST',
                    datatype: 'JSON',
                    success: function(result)
                    {
                        window.location.reload();
                    }
                }); 
            }
        }
    }
</script>