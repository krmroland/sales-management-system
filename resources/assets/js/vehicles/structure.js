
import BaseDataStructure from "../BaseDataStructure"

class structure extends BaseDataStructure
{
	constructor()
	{
		super([
				{
					name:"owner",
					label:"The name of the owner of the vehicle/motocycle"
				},
				{
					name:"phoneNumber",
					label:"The phoneNumber of the owner of the vehicle/motocycle"
				},
				{
					name:"numberPlate",

					label:"The vehicle's Plate Number"
				},
				{
					name:"national_id",

					label:"The National indetification number (NiN)"
				},

				{
					name:"category_id",

					label:"The vehicle's category",
					options:window.company.categories.parking,
					hasKeys:true

				}

				]);
	}

}

export default structure;