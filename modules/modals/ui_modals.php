<div class="modal fade" id="brand-registered" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Thank you for your registration! To complete the entire process, you need to click the link in the confirmation email that we have sent to you.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" onclick="returnIndex()" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="user-registered" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Thank you for your registration! To complete the entire process, you need to click the link in the confirmation email that we have sent to you.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" onclick="returnIndex()" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="item-unavailable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">We're sorry but it seems that this item is no longer available.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <div class="loading-div">
          <svg class="spinner" stroke="#5677fc" width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
        </div>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="update-complete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Updated successfully</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="insert-complete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Your item has been created successfully.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="delete-item-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">Are you sure you want to delete this item?</p>
      </div>

      <div class="modal-footer" style="border: none;">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Cancel</button>
        <button type="button" id="btn-delete-item-true" class="btn btn-dialog">Delete</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $brandname?></h4>
      </div>

      <div class="modal-body">
        <p class="lead">An error occured, please try again.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dialog" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->