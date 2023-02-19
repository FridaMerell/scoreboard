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
}