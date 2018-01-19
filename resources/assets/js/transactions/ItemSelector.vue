<template>
	<div class="form-group">
		<zoom>
			<div class="alert alert-danger h5 text-center" v-if="error">
				{{error}}
			</div>
		</zoom>
		<label for="" class="h6 font-italic">Please select an item</label>
		<input type="search" class="form-control bg-grey" v-model="query" ref="input" 
			placeholder="please select an item">
		<ul class="list-group" v-if="search.isActive">
			<li class="list-group-item is-10 text-white bg-primary">
				<i :class="search.icon" class="fa-lg"></i>
				<span class="px-3">{{search.text}}</span>
			</li>
		</ul>

		
			<ul class="list-group bg-grey" v-if="items">
				<a href="#" 
				class="list-group-item p-2 link-item bg-light"  
				@click.once="updateInput(item)"  
				v-for="item in items">
				<span>{{item.name}}</span>
				<span class="ml-3">({{item.sellingPrice|currency}})</span>
			</a>
		</ul>
	<zoom>
		<ul class="list-group" v-if="noItems">
			<li class="list-group-item is-10 text-danger bg-grey">
				<i class="fa fa-info"></i>
				<span class="px-3 text-info"> No matches Found for 
					<strike class="text-danger">{{query.substr(0,8)}}</strike>
						.....
				</span>
			</li>
		</ul>
	</zoom>

</div>
</template>
<script>
	export default{
		data()
		{
			return {
				query:'',
				error:null,
				items:null,
				shouldRun:true,
				search:{
					icon:'fa fa-spinner fa-spin',
					text:'',
					isActive:false,
				},
				noItems:false
			}
		},
		methods:{
			fetchData: _.debounce(function(){

				this.makeDataRequest();
			},500),

			makeDataRequest()
			{
				this.noItems=false;
				this.activateIndicator("Now fetching the data");
				axios.get("/items/search?name="+this.query).then(({data})=>{
					if(_.isEmpty(data)){
						this.noItems=true;
					}

					this.items=data;
					this.deActivateIndicator();

				}).catch(()=>{
					this.error="Something went wrong";
					this.deActivateIndicator();
					this.noItems=false;
				})

			},

			activateIndicator(message)
			{
				this.error=null;
				this.items=null;
				this.$set(this.search,'text',message);
				this.$set(this.search,'isActive',true);
			},
			deActivateIndicator()
			{
				this.$set(this.search,'isActive',false);
			},

			updateInput(item)
			{
				this.shouldRun=false;
				this.items=null;
				this.query=null;
				//this.query=item.name +'('+ this.numberFormat(item.sellingPrice)+')';

				this.$emit("selected",item);
			}



		},
		computed:{

		},
		watch:{
			query(current)
			{	
				if (!this.shouldRun) {
					this.shouldRun=true;

					return ;
				}
				this.noItems=false;
				this.activateIndicator("Waiting for you to finish typing");

				this.fetchData();
				
			}
		}
	}
</script>