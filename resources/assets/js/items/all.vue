<template>
	<div>
		<card>

			<search-selector label="Filter An Item" endPoint="/items" :hasDropDown="false" @results="items=$event">

			</search-selector>
		</card>
		<animation-list>
			<div v-for="item in items"  :key="item.item_id">
				<item :item="item" :readonly="false" >

				</item>
			</div>
		</animation-list>
	</div>
</template>

<script>
import Item from "./Item";
	export default
	{
		components:{Item},

		data(){
			return {
				items:[],
			}
		},

		created()
		{	this.fetchItems();

			events.$on("item:updated",item=>this.fetchItems());
			events.$on("item:deleted",item=>this.fetchItems());
			events.$on("item:created",item=>this.fetchItems());
		},
		methods:{

			fetchItems()
			{
				axios.get("/items").then(({data})=>this.items=data);
			},
		}
	}
</script>
