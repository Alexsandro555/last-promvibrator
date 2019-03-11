<template>
	<div  class='notifications'  v-if="notifications.length>0">
		<v-layout v-for='(notification,index) in notifications' class='notification' transition="slide-x-reverse-transition" :key=index>

			<v-badge overlay  color="purple" overlap  >
				<v-icon slot="badge" v-if=notification.value dark @click=delNotification(notification) class='cursor'>clear</v-icon >
				<v-alert v-if=true 
				transition="scale-transition"
				:type="notification.type" :value="notification.value">
					<avatar v-if=notification.avatar_id height="36" :client_id=notification.avatar_id></avatar>
					 <router-link v-if=notification.link :to="notification.link" style="text-decoration:none;color:#fff" >{{ notification.title }}<br />
					{{ notification.text }}</router-link>
					<span v-else>{{ notification.title }}<br />
					{{ notification.text }}</span>
				</v-alert>
				<v-list v-else two-line dense >
					<v-list-tile avatar v-if=notification.value :to=notification.link >
						<v-list-tile-avatar v-if=notification.avatar_id>
							<avatar  height="36" :client_id=notification.avatar_id></avatar>
						</v-list-tile-avatar>
						<v-list-tile-content>
							<v-list-tile-title v-html="notification.title"></v-list-tile-title>
							<v-list-tile-sub-title v-html="notification.text"></v-list-tile-sub-title>
						</v-list-tile-content>		
					</v-list-tile>
				</v-list>	
			</v-badge>
		</v-layout>
	</div>
</template>
<script>
import { mapGetters,mapActions } from 'vuex'
export default {
	methods: {
		...mapActions('notification',['delNotification']),
	},
	computed: {
		...mapGetters('notification',['notifications']),
	}
}
</script>
<style>
.notifications {
	position:fixed;
	width:325px;
	top: 65px;
	right:7px;
	z-index:9999999999;
}
.notification {
	margin-top:5px;	
}
.notifications .cursor {
	cursor:hand;
	cursor:pointer;
}
</style>