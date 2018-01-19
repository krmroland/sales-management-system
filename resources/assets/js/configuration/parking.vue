<template>
	<card>
		<div class=" row d-flex align-items-center  justify-content-between text-center">
			<div class="col-md-10">
				<h4  class="text-info text-center">Parking Categories</h4>
			</div>
			<div class="col-md-2">
				<button class="btn btn-outline-info mb-2" @click="addingCategory=true">
					<i class="fa fa-plus"></i>
					New Category
				</button>
			</div>
		</div>
		<zoom>
			<div v-if="categories.length" class="row box">
				<template v-for="category in categories" >
					<div class="col-md-6">
						<hoverable>
							<card>
								<div class="d-flex align-items-center justify-content-between text-center">
									<div>
										<i class="fa  fa-3x" :class="'fa-'+category.data.icon"></i>
									</div>


									<div>
										<h5>Category Name</h5>
										<p class="text-info h4">{{category.name}}</p>
									</div>
									<div>
										<h5>Ammount</h5>
										<p class="text-info h4">{{category.data.fee|currency}}</p>
									</div>
									<div>

										<button type="button" class="btn btn-outline-danger"
										title="delete this category"
										@click="destroy(category)">
										<i class="fa fa-trash"></i>
										Remove
									</button>

								</div>
								
							</div>
						</card>
					</hoverable>
				</div>
			</template>


		</div>
	</zoom>

	<modal :show="addingCategory" @closed="addingCategory=false">
		<h4 slot="header">Add A new Parking Category</h4>
		<VueForm action="/categories/parking" :fields="fields"
		@submitted="addedCategory">

	</VueForm>
</modal>
</card>

</template>

<script>
	import VueForm from "../forms/VueForm";
	import Confirmation from "../Confirmation";
	export default
	{
		components:{VueForm},

		props:[],

		data(){
			return {
				addingCategory:false,



				categories:company.parking,

				fields:[
				{
					name:"name",
					label:"The name of the category eg Small Vehicles"
				},
				{
					name:"fee",
					min:0,
					label:"The parking fee for every day eg 1000 for small"
				},
				{
					name:"icon",
					type:"radio",
					label:"Please select an icon ",
					options:{
						motorcycle:`<i class="fa fa-motorcycle fa-2x"></i> Motor cycles`,
						car:`<i class="fa fa-car fa-2x"></i> Small Cars`,
						bus:`<i class="fa fa-bus fa-2x"></i> Taxis`,
						truck:`<i class="fa fa-truck fa-2x"></i> Trucks`,
						
					}
				}

				]
			}
		},
		methods:{
			addedCategory(data)
			{

				this.categories.unshift(data);
				this.addingCategory=false;
				flash("Category added successfully");
			},
			destroy(category)
			{
				Confirmation.confirm("Stop!","The category will be removed permanently").
				then(response=>axios.delete("/categories/"+category.id).then(({data})=>{
					this.categories=data;
					location.reload();
					flash("Category was removed successfully");
				}));
			},
			// edit()
			// {
			// 	flash("This feature will be available as long as it is deemed nessart")
			// }
		}
	}
</script>
