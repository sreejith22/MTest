<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Author</th>
                <th>Description</th>
                <th>Subscription Created Date</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if($subscribtionDetails){
        foreach($subscribtionDetails as $subscribtion){ ?>
          <tr>
                <td><?php echo isset($subscribtion->author) ? $subscribtion->author:''; ?></td>
                <td><?php echo isset($subscribtion->story_text) ? $subscribtion->story_text:''; ?></td>
                <td><?php echo isset($subscribtion->subscription_created_date) ? date("Y-m-d", strtotime($subscribtion->subscription_created_date)):''; ?></td>
            </tr>
        <?php } } else { ?>
            <tr>
                <td style="text-align: center;">Not Subscribed </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>