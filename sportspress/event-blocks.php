<?php
/**
 * Event Blocks
 *
 * @author 		ThemeBoy
 * @package 	SportsPress/Templates
 * @version     1.9.13
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$defaults = array(
	'id' => null,
	'title' => false,
	'status' => 'future',
	'date' => 'default',
	'date_from' => 'default',
	'date_to' => 'default',
	'league' => null,
	'season' => null,
	'number' => -1,
	'link_teams' => 0,
	'link_events' => 0,
	'paginated' => 0,
	'rows' => '10',
	'order' => 'ASC',
	'show_all_events_link' => 0,
	'show_title' => true,
	'show_league' => true,
	'show_season' => true,
	'show_venue' => true,
);

extract( $defaults, EXTR_SKIP );

$calendar = new SP_Calendar( $id );
if ( $status != 'default' )
	$calendar->status = $status;
if ( $date != 'default' )
	$calendar->date = $date;
if ( $date_from != 'default' )
	$calendar->from = $date_from;
if ( $date_to != 'default' )
	$calendar->to = $date_to;
if ( $league )
	$calendar->league = $league;
if ( $season )
	$calendar->season = $season;
if ( $order != 'default' )
	$calendar->order = $order;
$data = $calendar->data();
$usecolumns = $calendar->columns;

if ( $show_title && false === $title && $id ):
	$caption = $calendar->caption;
	if ( $caption )
		$title = $caption;
	else
		$title = get_the_title( $id );
endif;

if ( isset( $columns ) ) {
	$usecolumns = $columns;
}

if ( $title )
	echo '<h4 class="sp-table-caption">' . $title . '</h4>';
?>
<div class="sp-template sp-template-event-blocks">
	<div class="sp-table-wrapper">
	<ul class="list-group">
				<?php
				$i = 0;

				if ( intval( $number ) > 0 )
					$limit = $number;

				foreach ( $data as $event ):
					if ( isset( $limit ) && $i >= $limit ) continue;

					$permalink = get_post_permalink( $event, false, true );
					$results = get_post_meta( $event->ID, 'sp_results', true );

					$teams = array_unique( get_post_meta( $event->ID, 'sp_team' ) );
					$teams = array_filter( $teams, 'sp_filter_positive' );
					$logos = array();

					$j = 0;
					foreach( $teams as $team ):
						$j++;
						if ( has_post_thumbnail ( $team ) ):
							if ( $link_teams ):
								$logo = '<a class="team-logo logo-' . ( $j % 2 ? 'odd' : 'even' ) . '" href="' . get_permalink( $team, false, true ) . '" title="' . get_the_title( $team ) . '">' . get_the_post_thumbnail( $team, 'sportspress-fit-icon' ) . '</a>';
							else:
								$logo = '<span class="team-logo logo-' . ( $j % 2 ? 'odd' : 'even' ) . '" title="' . get_the_title( $team ) . '">' . get_the_post_thumbnail( $team, 'sportspress-fit-icon' ) . '</span>';
							endif;
							$logos[] = $logo;
						endif;
					endforeach;
					?>
					<li class="list-group-item sp-row sp-post<?php echo ( $i % 2 == 0 ? ' alternate' : '' ); ?>">
							<h4 class="sp-event-title">
								<?php echo sp_add_link( $event->post_title, $permalink, $link_events ); ?>
							</h4>
							<?php echo implode( $logos, ' ' ); ?>

							<h5 class="sp-event-results">
								<time class="sp-event-date" datetime="<?php echo $event->post_date; ?>">
									<?php echo get_the_time( get_option( 'date_format' ), $event ); ?> |
								<?php if ( ! empty( $main_results ) ): ?>
									<span class="sp-result"><?php echo implode( $main_results, ' - ' ); ?></span>
								<?php else: ?>
									<span class="sp-result"><?php echo get_the_time( get_option( 'time_format' ), $event ); ?></span>
								<?php endif; ?>
								</time>
							</h5>

							<?php if ( $show_league ): $leagues = get_the_terms( $event, 'sp_league' ); if ( $leagues ): $league = array_shift( $leagues ); ?>
								<div class="sp-event-league"><?php echo $league->name; ?></div>
							<?php endif; endif; ?>
							<?php if ( $show_venue ): $venues = get_the_terms( $event, 'sp_venue' ); if ( $venues ): $venue = array_shift( $venues ); ?>
								<div class="sp-event-venue"><strong>Location:</strong> <?php echo $venue->name; ?></div>
							<?php endif; endif; ?>


						</li>

					<?php
					$i++;
				endforeach;
				?>
				</ul>
	</div>
	<?php
	if ( $id && $show_all_events_link )
		echo '<div class="sp-calendar-link sp-view-all-link"><a href="' . get_permalink( $id ) . '">' . __( 'View all events', 'sportspress' ) . '</a></div>';
	?>
</div>
