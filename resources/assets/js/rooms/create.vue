<template>
	<div>
		<VueForm action="/rooms" :fields="fields"
			@submitted="created">
		</VueForm>
	</div>
</template>

<script>
	import VueForm from"../forms/VueForm";
	export default
	{
		components:{VueForm},
		props:[],

		data(){
			return {
				fields:[
				{
					name:"name",
					label:"The Name of the room",

				},
				{
					name:"number",
					label:"The room number",

				},
				{
					name:"size",
					options:company.categories.rooms,
					label:"The size of the room"
				}
				]

			}

		},
		methods:{
			created(room)
			{
				this.$emit('room:created',room);
				flash("Room was created successfully");
			}
		}
	}
</script>
