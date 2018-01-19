<template>
	<VueForm :action="'/rooms/'+room.id+'/rates/'+rate.name" :fields="fields"
		@submitted="updated"
		method="put"
		>
	</VueForm>
</template>

<script>
import structure from "./structure";
import VueForm from "../../forms/VueForm";

	export default
	{
		props:["rate","room"],
		components:{VueForm},

		data(){
			return {
			fields:  (new structure()).binded(this.rate)
		 }
		},
		methods:{
			updated(room)
			{
				flash("The update was successfull");
				this.$emit("rate:updated",room);
			}
		}
	}
</script>
