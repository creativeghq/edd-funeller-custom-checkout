<div class="custom-checkout-main">
    <div class="custom-checkout-form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#basic">
                    <div class="label_index">1</div> 
                    <div class="heading">
                    	<div>Basic Info</div>
                    	<div class="subheading">
                    		 Enter your address
                     	</div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
            	<a class="nav-link disabled payment"  data-toggle="tab" href="#payment">
            	    <div class="label_index">2</div> 
            	    <div class="heading">
            	    	<div>Payment Info</div>
            	    	<div class="subheading">
            	    		 Make Payment
            	     	</div>
            	    </div>
            	</a>

            </li>
        </ul>
    </div>
    <div class="custom-checkout-form tab-content">
        <div class="tab-pane fade show active" id="basic">
            <?php 
            
            	require 'basic_info.php';
	  		 ?>
        </div>
        <div class="tab-pane fade" id="payment">
            <?php echo do_shortcode('[download_checkout]'); ?>
        </div>
    </div>
</div>