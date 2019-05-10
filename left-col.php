<div class="col-md-3 float-left">
    <div class="contest-block curve">
        <div class="contest-blog">
            <div class="contest-head">
                <h5>Ongoing Contest</h5>
            </div>
            <div class="contest-list list-contest">
                <ul>
                    <?php
                    $i = 1;
                    $sql = "SELECT banner,contest_name FROM `contest` WHERE status = 'Ongoing' AND system_status = 'Active' ";
                    $que = $db->query( $sql );
                    while ($row = $que->fetch_assoc()) {
                        $banner[] = $row['banner'];
                        ?>
                        <li><?php echo $row['contest_name']; ?></li>
                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
            <div class="contest-head">
                <h5>&nbsp;</h5>
            </div>

        </div>
        <div class="contest-blog">
            <div class="contest-head">
                <h5>Latest Contest</h5>
            </div>
            <div class="contest-list">
                <!--<img src="uploads/<?php /*echo $banner[0];*/?>" class="img-responsive" />-->
                <!--<img src="../assets/images/ongoing-reward.jpg" class="img-responsive" />-->
                <div class="cycle-slideshow" data-cycle-fx=scrollHorz data-cycle-timeout=2000>
                    <!-- empty element for caption -->
                    <!--<div class="cycle-caption"></div>-->
                    <?php
                    foreach ($banner as $b){
                        ?>
                        <img src="uploads/<?php echo $b;?>" class="img-responsive">
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>