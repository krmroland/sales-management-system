<template>
	<card>
		<vue-table :endPoint="endPoint" 
		:title="title"
		placeholder="Filter dates"
		@rowClicked="transaction=$event;isShowingResult=true"
		>
		<table-cell label="date" data-name="date"></table-cell>
		<table-cell label="Type" data-name="type" filter="title"></table-cell>
		<table-cell label="description" data-name="description"></table-cell>

		<table-cell label="TotalAmmount" data-name="ammount" 
			filter="currency">

		</table-cell>
		<table-cell label="Ammount Paid" data-name="paid" 
			filter="currency">

		</table-cell>

	</vue-table>
	<modal :show="isShowingResult" @closed="isShowingResult=false;transaction={}">
		<h4 slot="header">{{transaction.description}}</h4>
		<card>
			

			<div class="d-flex justify-content-between align-items-center  mb-2">
				<div class="text-center text-primary col-md-8">
					<h4>
						<i class="fa fa-balance-scale"></i>
						General Transaction Summarry
					</h4>
				</div>
				<button class="btn btn-outline-danger" @click="destroy(transaction)">
					<i class="fa fa-trash"></i>
					Delete this Transaction
				</button>
			</div>
			<!-- summaries table -->
			<table class="table table-bordered table-sm table-hover table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Description</th>
						<th>Paid</th>
						<th>{{transaction.type=="sale"?"Change":"Debt"}}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{transaction.date}}</td>
						<td>
							{{transaction.type=='sale'?'Sold':'Purchased'}}
							Items worth {{transaction.ammount|currency}}
						</td>
						<td>
							{{transaction.paid|currency}}
						</td>
						<td>
							{{Math.round(transaction.paid-transaction.ammount,1)}}
						</td>
					</tr>
				</tbody>
			</table>
		</card>
		<card>
		<!-- the item details here -->
			<h5 slot="title">Item Details</h5>
			<div v-if="transaction.details && transaction.details.length">
				<table class="table table-bordered table-sm table-striped">
					<thead>
						<tr>
							<th>Item Name</th>
							<th>Opening</th>
							<th>
								{{transaction.type=="sale"?"Sold":"Purchased"}}
							</th>
							<th>
								Closing
							</th>
							<th>
								
								{{transaction.type=="sale"?"Bought at":"SetBuying Price"}}
							</th>
							<th>
								{{transaction.type=="sale"?"Sold at":"Purchased At"}}
							</th>
							<th>
								{{transaction.type=="sale"?"Profit Made":"Profit Expected"}}
							</th>	
						</tr>
					</thead>
					<tbody>
						<tr v-for="detail in transaction.details">
							<td>{{detail.item.name}}</td>
							<td>
								{{detail.opening|currency}} 
								{{detail.item.bundle.unitPlural}}
							</td>
							<td>
								{{detail.new|currency}} 
								{{detail.item.bundle.unitPlural}}
							</td>
							<td>
								{{detail.closing|currency}} 
								{{detail.item.bundle.unitPlural}}
							</td>
							<td>
								{{detail.currentPrice|currency}}
							</td>
							<td>
								{{detail.transactedAt|currency}}
							</td>
							<td>
								{{profit(transaction,detail)|currency}}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="alert alert-danger text-center h5" v-else>
				No item Details were captured for this sale!
			</div>
		</card>
	</modal>
</card>
</template>

<script>
import Confirmation from "../Confirmation";
	export default
	{
		props:["type"],


		data(){
			return {

				transaction:{},
				isShowingResult:false
			}
		},

		methods:{
			profit(transaction,detail)
			{
				let gain=Number(detail.transactedAt-detail.currentPrice) *detail.new;
				return transaction.type=="sale"?gain:gain*-1;
			},
			destroy(transaction)
			{
				Confirmation.confirm("Stop!","The transaction will be deleted permanently").
				then(confirmed=>{
					axios.delete("/transactions/"+transaction.id).then(response=>{
						flash("Transaction was removed completely");
						this.transaction={};
						this.isShowingResult=false;
						events.$emit("table:refresh");
					})
				})
			}
		},
		computed:{
			title()
			{
				if (!this.type) return "General Items Transaction History";

				return this.type=="sale"?"Recent Sales History":"Recent Purchases History"
			},
			endPoint()
			{
				return !this.type?'/transactions':'/transactions?type='+this.type;
				
			}
		}
	}
</script>
