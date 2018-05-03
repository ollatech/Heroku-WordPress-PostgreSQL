<footer class="ux-footer bg-grey">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md">
        <?php //echo Stencil_Template()->logo(); ?>
        <small class="d-block mb-3 text-muted"><?php// echo Stencil_Template()->copyright(); ?></small>
      </div>
      <div class="col-6 col-md">
        <?php
        //Stencil_Template()->widget('foter-1');
        ?>
        <?php if ( is_active_sidebar( 'foter-1' ) ) : ?>
          <div class="widget-area sidebar">
            <?php dynamic_sidebar( 'footer-1' ); ?>
          </div>
          <?php
        elseif(stencil_dev()):
          ?>
          <h5>Footer Widget 1</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
          <?php
        endif; 
        ?>
      </div>
      <div class="col-6 col-md">
        <?php
       // Stencil_Template()->widget('foter-2');
        ?>
        <?php if ( is_active_sidebar( 'foter-2' ) ) : ?>
          <div class="widget-area sidebar">
            <?php dynamic_sidebar( 'footer-2' ); ?>
          </div>
          <?php
        elseif(stencil_dev()):
          ?>
          <h5>Footer Widget 2</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
          <?php
        endif; 
        ?>
      </div>
      <div class="col-6 col-md">
        <?php
        //Stencil_Template()->widget('foter-3');
        ?>
        <?php if ( is_active_sidebar( 'foter-3' ) ) : ?>
          <div class="widget-area sidebar">
            <?php dynamic_sidebar( 'footer-3' ); ?>
          </div>
          <?php
        elseif(stencil_dev()):
          ?>
          <h5>Footer Widget 3</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
          <?php
        endif; 
        ?>
      </div>

      <div class="col-6 col-md">
        <?php
        //Stencil_Template()->widget('foter-4');
        ?>
        <?php if ( is_active_sidebar( 'foter-4' ) ) : ?>
          <div class="widget-area sidebar">
            <?php dynamic_sidebar( 'footer-4' ); ?>
          </div>
          <?php
        elseif(stencil_dev()):
          ?>
          <h5>Footer Widget 4</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
          <?php
        endif; 
        ?>
      </div>

    </div>
  </div>
</footer>