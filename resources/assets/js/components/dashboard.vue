<template>
	<div class="row ">
		<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar px-0">
			<div class="list-group">
				<p  class="list-group-item  justify-content-center  h4 active py-4">
					Recent Logs
				</p>
				<template v-for="log in logs">
					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start" >
						<div class="d-flex w-100 justify-content-between">
							<h6 class="mb-1">{{log.description|title}}</h6>
							<small class="text-muted">{{log.created_at}}</small>
						</div>
						<p class="mb-1 " v-if="log.logger">
							{{log.logger.description|capitalize}}
						</p>
					</a>
				</template>

			</div>
		</nav>
		<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
			<item-summary>
				<h4 class="text-center text-primary">Item Inventories</h4>
			</item-summary>
			<div class="row">
				<div class="col-md-6" v-for="card in cards">
					<hoverable>
						<div class="card mt-2 border-2">
							<div class="card-block d-flex align-items-center justify-content-between" >
								<span class="fa-stack fa-4x">
									<i class="fa fa-circle fa-stack-2x text-primary"></i>
									<i class="fa  fa-stack-1x  text-white" :class="card.icon"></i>
								</span>
								<div>
									
								</div>
								<div>
									<h4 class="text-primary">{{card.label}}</h4>
								</div>
								<div>
									<h1 class="text-muted text-info mr-2">
										<counter :value="count(card.name)"></counter>
									</h1>
								</div>
								<div>
									<a :href="card.href" class="btn btn-outline-primary">
										<i class="fa fa-external-link-square "></i>
									</a>
								</div>
							</div>
						</div>
					</hoverable>
				</div>
			</div>
		</main>
		<processor :shouldProcess="isFetching" message="Compiling Data"></processor>
	</div>

</template>

<script>
	import ItemSummary from "../items/summary";

	import Processor from "../components/processor";

	export default
	{
		components:{ItemSummary,Processor},

		created()
		{
			this.fetchData()

		},


		data(){
			return {
				isFetching:false,
				data:{},
				cards:[

				{
					name:"items",
					icon:"fa fa-balance-scale",
					label:"Stock (Items)",
					href:"/items"
				},
				{
					icon:"fa-bus",
					name:"vehicles",
					label:"Registered Vehicles",
					href:"/parking"
				}
				,
				{
					name:"rooms",
					icon:"fa fa-bed",
					label:"Rooms",
					href:"/accomodation"
				},
				{
					name:"employees",
					icon:"fa fa-group",
					label:"Employees",
					href:"/employees"
				}
				]
			}
		},
		methods:{
			fetchData()
			{
				this.isFetching=true;
				axios.get("/home").then(({data})=>{
						this.data=data;
						this.isFetching=false
					}).catch(error=>this.isFetching=false);
			},
			count(name)
			{
				if (this.data.hasOwnProperty("counts")) {
					return Number(this.data.counts[name]);
				}
				return 0;
			}
		},
		computed:{
			logs()
			{
				if (this.data) {
					return this.data.logs
				}
				return {};
			}
		}
	}
</script>
<style >
/* 	@import "resources/assets/sass/colors"; */
	.sidebar {
		position: fixed;
		top: 50px;
		bottom: 0;
		left: 0;
		z-index: 1000;
		width:100%;
		background-color:white;
	 	/* padding: 20px; */
	 	overflow-x: hidden;
	 	overflow-y: auto;
	 	/* border-right: 2px solid $brand-primary; */
	 }

	</style>