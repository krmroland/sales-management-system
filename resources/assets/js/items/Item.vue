<template>
	<card>
		<div class="d-flex box justify-content-between align-items-center text-center text-muted">
			<div>
				<p class="h5">Name</p>
				<p class="h5 text-info">{{item.name|title}}</p>
			</div>
			<div>
				<p class="h5">Category</p>
				<p class="h5 text-info">{{item.category|title}}</p>
			</div>
			<div>
				<p class="h5">Buying Price</p>
				<p class="h5 text-info">{{item.buyingPrice|currency}}</p>
			</div>
			<div>
				<p class="h5">Selling Price</p>
				<p class="h5 text-info">{{item.sellingPrice|currency}}</p>
			</div>
			<div>
				<p class="h5">Quantity Present</p>
				<p class="h6 text-info font-italic">{{item.bundle.name}}</p>
			</div>
			<div class="btn-group" v-if="!readonly">
			<a  class="btn btn-outline-primary" :href="'/items/'+item.item_id">
				<i class="fa fa-external-link-square"></i>
				Details
			</a>
			<button type="button" class="btn btn-outline-warning" title="Adjust the items prices" 
				@click="isEditingPrices=true">
				<i class="fa fa-refresh"></i>
				prices
			</button>
			<button type="button" class="btn btn-outline-primary" title="change the prices" @click="isEditing=true">
				<i class="fa fa-edit"></i>
			</button>
			<button type="button" class="btn btn-outline-danger"  title="Delete Item" @click="deleteItem">
				<i class="fa fa-trash"></i>
			</button>
		</div>


</div>
<!-- editing item details -->
<modal :show="isEditing" @closed="isEditing=false">
	<h3 slot="header">Edit {{item.name|title}}</h3>
	<item-editor :item="item" @updated="updated"></item-editor>
</modal>
<!-- editing prices -->
<modal :show="isEditingPrices" @closed="isEditingPrices=false">
	<h3 slot="header">Adjust ( {{item.name|title}}) Prices</h3>
	<price-editor :item="item" @updated="isEditingPrices=false"></price-editor>
</modal>
</card>
</template>
<script>
	import ItemEditor from "./edit";
	import PriceEditor from "./editPrices";

	import Confirmation from "../Confirmation";

	export default
	{

		components:{ItemEditor,PriceEditor},

		props:{
			item:{
				type:Object,
				
			},
			readonly:{
				default:true,
			}

		},
		data()
		{
			return {
				isEditing:false,
				isEditingPrices:false,
			}
		},
		methods:{
			deleteItem()
			{
				Confirmation.confirm("Stop?",this.item.name+" will be deleted permanently")
				.then(()=>{
					axios.delete("/items/"+this.item.item_id)
					.then(()=>{
						flash("Item Deleted Success fully!");
						this.$emit("deleted");
						events.$emit("item:deleted");
					})
				})
			},
			updated()
			{
				this.isEditing=false;
			}
		}
		
	}
</script>
