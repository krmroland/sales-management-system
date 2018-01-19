<template>
	<div>
		<card>
			<div class=" row d-flex align-items-center  justify-content-between text-center mx-2 box">
				<div>
					<p class="h5">Total Rooms</p>
					<p class="h4">
						<counter :value="rooms.length"></counter>
					</p>
				</div>
				<div class="">
					<h4  class="text-info text-center">The Available Rooms</h4>
				</div>
				<div class="">
					<button class="btn btn-outline-primary mb-2" @click="addingRoom=true">
						<i class="fa fa-plus"></i>
						Register A New Room
					</button>
				</div>
			</div>

		</card>

        <div  v-for="room in rooms">
        	<room :room="room" :readonly="false"></room>
        </div>
		<modal :show="addingRoom" @closed="addingRoom=false">
			<h4 slot="header">Register A New Room</h4>
			<create @room:created="addRoom"></create>
		</modal>
</div>
</template>

<script>

	import create from "./create";
	import room from "./room";
	export default
	{
		components:{create,room},

		created()
		{
			this.fetchRooms();
		},


		data(){
			return {
				addingRoom:false,
				rooms:[],

			}
		},
		methods:{
			addRoom(room)
			{
				this.addingRoom=false;

				this.rooms.unshift(room);
			},
			fetchRooms()
			{
				axios.get("/rooms").then(({data})=>this.rooms=data);
			}
		}
	}
</script>
