<template>
	<div>
		<card>
		<h5 slot="title" class="text-primary">
			<i class="fa fa-thumbs-o-up"></i>
			Please select the date and items to transact
		</h5>
			<div class="row d-flex justify-content-center  align-items-center box">

				<div class="col-md-6">
					<item-selector @selected="addItem"></item-selector>
				</div>
				<div class="col-md-6">
					<date @dateChanged="date=$event"></date>
				</div>

			</div>
		</card>
		<zoom>
			<!-- items summary -->
			<div v-if="!nullItems">
				<card>
					<div class="d-flex justify-content-between align-items-center text-center box">
						<div>
							<p class="h5 text-muted">Selected Items</p>
							<p class="h4 text-info">
								<counter :value="totalItems"></counter>
							</p>
						</div>
						<div>
							<p class="h5 text-muted">Total Ammount</p>
							<p class="h4 text-info">
								<counter :value="totalAmmount"></counter>
							</p>

						</div>
						<div>
							<!-- <p class="h5 text-muted">
								
						</p> -->
						<input type="number"
						class="form-control  text-center text-info" 
						v-model="paid"
						:placeholder="'Ammount '+(type=='sale'?'Paid':'Purchased')" 
						>
					</div>
					<div v-if="type=='sale'">
						<p class="h5">Change</p>
						<p class="h4">
							<counter :value="change"></counter>
						</p>
					</div>

					<div>
						<button class="btn btn-outline-info btn-block" @click="transact">
							<i class="fa fa-shopping-cart"></i>
							{{buttonName|title}}
						</button>
					</div>
				</div>
			</card>

			<card>
				<h5 class="font-italic text-center text-primary ">
					<i class="fa fa-long-arrow-down"></i>
					click on the items header to diselect It
				</h5>
				<template v-for="(item,key) in items">
					<item :item="item" @processed="addProcessedItem" :type="type">

					</item>
				</template>
			</card>
		</div>
	</zoom>

	<processor message="Processing Transaction" :shouldProcess="isProcessing">

	</processor>

</div>
</template>

<script>
	import Confirmation from "../Confirmation";
	import Item from "./item";
	import date from "../components/date";
	import ItemSelector from "./ItemSelector";
	import processor from "../components/processor";
	import {size,isEmpty,sum,values,map} from "lodash";
	export default{

		props:["type","buttonName","url"],
		components:{Item,processor,ItemSelector,date},

		created()
		{
			events.$on("item:removed",itemId=>{
				this.$delete(this.items,itemId.toString());
				this.$delete(this.processedItems,itemId.toString());
			});
		},
		data()
		{
			return {
				paid:'',
				items:{},
				processedItems:{},
				date:'',
				isProcessing:false
			}
		},
		methods:{
			
			transact()
			{
				if(!this.isValid){
					return false;
				}

				if (this.change<0) {
					Confirmation.confirm("Confirm",this.invalidPaymentText)
					.then(confirmed=>this.submit());
				}else{
					this.submit();
				}

			},

			addItem(item)
			{
				if (this.items.hasOwnProperty(item.item_id)) {
					flash(item.name+' ais already selected',"info");
					return 
				}
				this.$set(this.items,item.item_id,item);

			},
			addProcessedItem({itemId,data})
			{
				this.$set(this.processedItems,itemId,data);
			},

			submit()
			{
				this.isProcessing=true;

				axios.post("/transactions",this.formData).then(({data})=>{
					this.isProcessing=false;
					flash(this.type+"was processed successfully");
					this.items={};
					this.processedItems={};
					this.paid=null;
					this.$emit("finished");
				}).catch(error=>this.isProcessing=false);
			},
		},
		computed:{
			change()
			{
				return Number(this.paid-this.totalAmmount);
			},
			totalAmmount()
			{
				let total=sum(map(this.processedItems,item=>item.total))
				this.$emit("totalAmmount",total);
				return total;
			},
			nullItems()
			{
				return isEmpty(this.items);
			},

			
			totalItems()
			{
				return size(this.items);
			},
			formData()
			{
				return {
					date:this.date,
					paid:this.paid,
					ammount:this.totalAmmount,
					items:JSON.stringify(this.processedItems),
					type:this.type,

				}
			},
			isValid()
			{
				if (!this.date) {
					flash("Please make sure you select a date first!");
					return false ;
				}

				if (this.totalAmmount<=0) {
					flash("Please select some items before procceding" ,"danger");
					return false;
				}

				return true;

			},

			invalidPaymentText()
			{
				let initialText="The ammount paid is less than the total ammount by";

				let ammount=`<br>${this.numberFormat(this.change*-1)}</br>`;

				if (this.type=="sale") {
					return `${initialText}${ammount}<br>Do you intend to give a debt?`
				}
				return `${initialText}${ammount}<br>Did you purchase on credit?`				
			}
		}


	}

</script>

<style lang="scss">
	@import "resources/assets/sass/colors";

	.border-right{
		border-right:8px solid $brand-primary;
	}
	.border-left{
		border-left:8px solid $brand-primary;
	}
</style>