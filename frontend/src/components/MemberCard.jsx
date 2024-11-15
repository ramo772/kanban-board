import React from "react"
import { useDrag } from "react-dnd"

export default function MemberCard({ card, section, onDelete, openFormState }) {
	const [{ isDragging }, drag] = useDrag(() => ({
		type: "MEMBER_CARD",
		item: { card, type: "MEMBER_CARD", currentSection: section },
		collect: (monitor) => ({
			isDragging: monitor.isDragging(),
		}),
	}))

	return (
		<div
			ref={drag}
			className={`  z-10 transition-all duration-200 ${
				isDragging
					? "opacity-50 scale-95"
					: !openFormState
					? "opacity-100 scale-100 relative  transform"
					: ""
			} member-card p-6 m-2 bg-white rounded-lg shadow-sm hover:shadow-md cursor-move group`}
		>
			<div className="flex justify-between mb-2">
				<span className="text-black font-semibold">
					{`${card?.title} ${card?.name}`}{" "}
				</span>
				<span className="text-gray-400">{card?.age} yo</span>
			</div>
			<div className="flex justify-between mb-2">
				<span className="text-gray-800 text-sm font-light">{card?.email}</span>
			</div>
			<div className="flex justify-between mb-2">
				<span className="text-gray-600 text-xs font-light">
					{card?.mobile_number}
				</span>
			</div>
			<button
				onClick={() => onDelete(card)}
				className=" top-2 right-2 rounded-md bg-red-500 text-white w-full p-1  group-hover:opacity-100 transition-opacity duration-200 focus:outline-none"
			>
				Delete
			</button>
		</div>
	)
}
