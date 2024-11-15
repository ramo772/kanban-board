import React from "react"
import { useDrop } from "react-dnd"
import MemberCard from "./MemberCard.jsx"
import { deleteCard, updateMemberStatus } from "../api/apiHelper.js"

export default function BoardSection({
	title,
	createButton,
	setOpenFormState,
	setCards,
	cards,
	openFormState,
	setShowToast,
}) {
	const [, drop] = useDrop(() => ({
		accept: "MEMBER_CARD",
		drop: (item) => {
			const updatedItem = { ...item?.card, status: title }
			setCards((prevCards) =>
				prevCards.map((card) =>
					card.id === item?.card?.id ? updatedItem : card
				)
			)
			updateMemberStatus(item?.card?.id, title)
		},
		collect: (monitor) => ({
			isOver: monitor.isOver(),
		}),
	}))

	const onDelete = (card) => {
		setCards((prevCards) => prevCards.filter((item) => item.id !== card?.id))

		deleteCard(card?.id)
			.then(() => {
				setShowToast("Card deleted successfully")
				setTimeout(() => setShowToast(false), 2000)
			})
			.catch((error) => {
				setCards((prevCards) => [...prevCards, card])
				setShowToast(error?.response?.data?.message)
				setTimeout(() => setShowToast(false), 2000)
			})
	}

	return (
		<div ref={drop} className="flex-1 ">
			<div className="bg-blue-300 border border-blue-400 rounded-lg h-full mt-2 p-4 flex flex-col m-3">
				<div className="flex justify-between mb-3 text-black font-normal">
					<b>{title}</b>
					<span className="w-8 h-6 bg-white rounded-full flex items-center justify-center text-black">
						{" "}
						{cards?.length}
					</span>
				</div>
				<div className="overflow-y-auto max-h-96">
					{cards.map((card) => (
						<MemberCard
							onDelete={onDelete}
							key={card?.id}
							card={card}
							openFormState={openFormState}
							section={title}
						/>
					))}
					{createButton && (
						<button
							onClick={() => setOpenFormState(true)}
							class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
						>
							Add
						</button>
					)}
				</div>
			</div>
		</div>
	)
}
