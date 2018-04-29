<div class="modal fade fullpage" id="menuModal" tabindex="-1" role="dialog"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mega-menu">
          <div class="container">
            <?php
            wp_nav_menu( array(
              'theme_location'    => 'main_menu',
              'depth'             => 4,
              'container'         => false,
              'menu_class'        => 'nav'
            ) );
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>