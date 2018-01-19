<template>
	<VueForm :action="'/items/'+item.item_id"  	
			  method="put"
			 :fields="fields" @submitted="doneEditing">

	</VueForm>
</template>

<script>

	

	import VueForm from "../forms/VueForm";

	import structure from "./structure";

	export default
	{
		components:{VueForm},

		props:["item"],

		data()
		{
			return{
				fields: (new structure()).binded(this.item)
			}
		},
		methods:{
			doneEditing(data)
			{
				flash("Item was updated successfully");

				

				events.$emit("item:updated",data);
				
				this.$emit("updated",data);
			}
		}
	}
</script>