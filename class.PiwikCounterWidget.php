<?php

/**
 * @pakage PiwikCounter
 */

class PiwikCounterWidget extends WP_Widget {
	
	function PiwikCounterWidget() 
	{
		parent::WP_Widget(false, $name = 'PiwikCounter');
	}

	function form($instance) 
	{
		$title = esc_attr($instance['title']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php 
	}

	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
	}

	function widget($args, $instance) 
	{
		extract( $args );
        
		$visitors = new Visitors();
		
		// Update piwikcounter_visitors_yesterday if date of last change and actual date don't match
		if ( get_option('piwikcounter_visitors_last_change') != date("Y-m-d") ) {
				$visitors->updateYesterdayVisitors;
		}
		
		// Get today's visits
		$visits_today = (int) $visitors->getTodaysVisitors();
		$all_visits = (int) $visits_today + (int) get_option('piwikcounter_visitors_yesterday');
		
		$title = apply_filters('widget_title', $instance['title']);
		
		echo $before_widget;
        if ( $title ) { echo $before_title . $title . $after_title; }
		
		// Output complete amount of visitors since the specified date
		echo '<div style="text-align: center;">';
		printf ( __( "%d visitors<br/>since" ), $all_visits);
		
		// Output amount of visitors who came today
		echo date(" F Y", strtotime(get_option('piwikcounter_start_date')) ) .'<br/>';
		printf ( __( "%d<br/>visits today" ), $visits_today );
		
		echo '</div>';
	
		echo $after_widget;
	}

}

?>