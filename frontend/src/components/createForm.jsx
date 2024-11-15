import React from "react"
import { useFormik } from "formik"
import * as Yup from "yup"
import InputField from "./Form/InputField"

export default function CreateForm({ setOpenFormState, addNewCard }) {
	const formik = useFormik({
		initialValues: {
			title: "",
			name: "",
			age: "",
			email: "",
			mobile_number: "", // Ensure this field is included and not undefined
		},
		validationSchema: Yup.object({
			title: Yup.string().required("Title is required"),
			name: Yup.string().required("Name is required"),
			age: Yup.number()
				.required("Age is required")
				.positive("Age must be positive")
				.integer("Age must be an integer"),
			email: Yup.string()
				.email("Invalid email address")
				.required("Email is required"),
			mobile_number: Yup.string().required("Phone is required"), // Ensure validation for this field
		}),
		onSubmit: (values) => {
            addNewCard(values)
		},
	})

	return (
		<div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
			<div className="bg-white rounded-lg p-6 shadow-lg w-11/12 md:w-1/3">
				<form onSubmit={formik.handleSubmit} className="flex flex-col gap-6">
					<h2 className="text-xl font-semibold mb-4">Create New Entry</h2>
					{["title", "name", "age", "email", "mobile_number"].map((field) => (
						<InputField field={field} key={field} formik={formik} />
					))}
					<div className="flex gap-4">
						<button
							type="submit"
							className="bg-blue-500 text-white p-2 rounded-md flex-1 hover:bg-blue-600"
						>
							Submit
						</button>
						<button
							type="button"
							onClick={() => setOpenFormState(false)}
							className="bg-red-500 text-white p-2 rounded-md flex-1"
						>
							Close
						</button>
					</div>
				</form>
			</div>
		</div>
	)
}
