import React from "react"

export default function InputField({field, formik}) {
	return (
		<div key={field}>
			<label
				htmlFor={field}
				className="block text-sm font-medium text-gray-700 capitalize"
			>
				{field.replace(/_/g, ' ').replace(/\b\w/g, (char) => char.toUpperCase())}:
			</label>
			<input
				type="text"
				id={field}
				name={field}
				className="mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 w-full"
				onChange={formik.handleChange}
				onBlur={formik.handleBlur}
			/>
			{formik.touched[field] && formik.errors[field] ? (
				<div className="text-red-500 text-sm">{formik.errors[field]}</div>
			) : null}
		</div>
	)
}
