<template>
	<VueForm :action="'/items/'+item.item_id+'?isEditingPrices=true'" 	
			  method="put"
			 :fields="fields" @submitted="doneEditing">
			 <p class="text-danger text-center font-italic">
			 	Normally Theses values should adjust themseleves accordingly! This option is meant to reset them back just in case thisng go wrong!
			 </p>
	</VueForm>
</template>

<script>

	

	import VueForm from "../forms/VueForm";

	export default
	{
		components:{VueForm},

		props:["item"],

		data()
		{
			return{
				fields: [
				{
					name:"quantity",
					value:this.item.availableQuantity,
					step:0.05

				},
				{
					name:"buyingPrice",
					type:"number",
					value:this.item.buyingPrice,
					step:0.05

				},
				{
					name:"sellingPrice",
					type:"number",
					value:this.item.sellingPrice,
					step:0.05
				}
				]
			}
		},
		methods:{
			doneEditing(data)
			{
				flash("Prices Adjusted Accordingly");

				

				events.$emit("item:updated",data);
				
				this.$emit("updated",data);
			}
		}
	}
</script>