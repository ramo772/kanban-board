<?php

namespace App\Http\Services;

use App\Models\Building;
use App\Models\MemberCard;
use App\Repositories\MemberCardRepository;
use App\Repositories\ImageRepository;
use Exception;
use Illuminate\Http\Response;

class MemberCardService extends _Service
{
    protected $MemberCardRepository;

    public function __construct(
        protected MemberCardRepository $memberCardRepository,
    ) {
    }

    protected function getAll()
    {
        try {
            $member_cards = $this->memberCardRepository->findAll();
            return returnData(
                [],
                Response::HTTP_OK,
                compact('member_cards'),
                ['Returned successfully']
            );
        } catch (\Exception $e) {
            logger(
                [
                    'error' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        }
    }
    protected function create($data)
    {
        try {
            $data['order'] = $this->memberCardRepository->getLastOrder() + 1;
            $member_card = $this->memberCardRepository->create($data->toArray());
            return returnData(
                [],
                Response::HTTP_OK,
                compact('member_card'),
                ['Created successfully']
            );
        } catch (\Exception $e) {
            dd($e);
            logger(
                [
                    'error' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        }
    }
    protected function updateStatus($new_status, string $member_card_id)
    {
        try {
            $member_card = $this->memberCardRepository->find($member_card_id);
            $current_status = $member_card->getRawOriginal('status');
            $new_status_value = strtolower(str_replace(' ', '_', $new_status['status']));
            if ($current_status !== $new_status_value) {
                $old_status_cards = $this->memberCardRepository->findBy(['status' => $current_status]);
                foreach ($old_status_cards as $card) {
                    if ($card->id !== $member_card_id && $card->order > $member_card->order) {
                        $card->order -= 1;
                        $card->save();
                    }
                }

                $new_status_cards = $this->memberCardRepository->findBy(['status' => $new_status_value]);
                foreach ($new_status_cards as $card) {
                    if ($card->order >= $new_status['order']) {
                        $card->order += 1;
                        $card->save();
                    }
                }
            }
            if ($current_status == $new_status_value) {
                $status_cards = $this->memberCardRepository->findBy(['status' => $current_status]);
                foreach ($status_cards as $card) {
                    if ($card->id !== $member_card_id && $card->order > $member_card->order) {
                        $card->order -= 1;
                        $card->save();
                    }
                }

            }

            $updated_member_card = $this->memberCardRepository->update($new_status->toArray(), $member_card_id);

            $member_card->refresh();
            return returnData(
                [],
                Response::HTTP_OK,
                compact('member_card'),
                ['Updated sucessfully']
            );
        } catch (\Exception $e) {
            dd($e);
            logger(
                [
                    'error' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        }
    }
    public function delete($member_card_id)
    {
        try {
            $member_card = $this->memberCardRepository->delete($member_card_id);
            return returnData(
                [],
                Response::HTTP_OK,
                [],
                ['Deleted successfully']
            );
        } catch (\Exception $e) {
            logger(
                [
                    'error' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        }
    }
}
