import React from "react"
import CreateForm from "./createForm.jsx"
import { useEffect, useState } from "react"
import { createCard, fetchCards } from "../api/apiHelper"
import BoardSection from "./BoardSection"
import Toast from "./Toast.jsx"

export default function Board() {
	const boards = [
		"Un Claimed",
		"First Contact",
		"Preparing Work Offer",
		"Send To Therapist",
	]
	const [openFormState, setOpenFormState] = useState(false)
	const [cards, setCards] = useState([])
	const [showToast, setShowToast] = useState(false)

	useEffect(() => {
		fetchCards().then((data) => setCards(data))
	}, [])
    const addNewCard = (card) => {
        createCard(card)
          .then((data) => {
            card.status = "Un Claimed";
            setShowToast("Card created successfully");
            setCards([...cards, card]);
            setOpenFormState(false);
            setTimeout(() => setShowToast(false), 1000);
          })
          .catch((error) => {
            setShowToast(error?.response?.data?.message);
          });
      };
	return (
		<div className="bg-blue-200 min-h-screen p-5">
			<Toast
				message={showToast}
				show={showToast}
				onClose={() => setShowToast(false)}
			/>

			{openFormState && (
				<div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
					<div className="bg-white rounded-lg p-6 shadow-lg w-11/12 md:w-1/3">
						<CreateForm
							addNewCard={addNewCard}
							setOpenFormState={setOpenFormState}
						/>
					</div>
				</div>
			)}
			<div className="flex flex-row text-white">
				<div className="flex flex-col w-full text-center">
					<div className="flex flex-row h-full justify-between gap-2">
						{boards.map((item, index) => (
							<BoardSection
								key={item?.id}
								title={item}
								setCards={setCards}
								cards={cards
									.filter((card) => card.status === item)
									.sort((a, b) => a.order - b.order)}
								createButton={index === 0}
                                setShowToast={setShowToast}
								openFormState={openFormState}
								setOpenFormState={setOpenFormState}
							/>
						))}
					</div>
				</div>
			</div>
		</div>
	)
}
