import {Controller} from "@hotwired/stimulus";
import axios from "axios";

export default class extends Controller {
	static targets = [
		'form',
		'email'
	]

	connect() {
		super.connect();
	}

	async send(e) {

		e.stopPropagation()
		e.preventDefault()
		const email = this.emailTarget.value
		const formData = new FormData(this.formTarget)
		let data = Object.fromEntries(formData)
		const response = await axios.post('/submit', data)
	}

	async aCrimeIsCommitted(){
		const messages = [
			"Är du helt 100 på det här?",
			"Det verkar troligt att det är du som är problemet",
			"Mobbning är inte okej!"
		]

		const message = messages.items[Math.floor(Math.random()*messages.length)];
	}
}