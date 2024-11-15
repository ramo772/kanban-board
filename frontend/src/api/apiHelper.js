import axiosInstance from './axiosInstance';

export const fetchCards = async () => {
    try {
        const response = await axiosInstance.get('/cards');
        return response.data.data.member_cards;
    } catch (error) {
        console.error('Error fetching members:', error);
        throw error;
    }
};

export const updateMemberStatus = async (cardId, newStatus) => {
    try {
        const response = await axiosInstance.put(`/cards/${cardId}`, { status: newStatus, order: 1 });
        return response.data;
    } catch (error) {
        console.error('Error updating member status:', error);
        throw error;
    }
};

export const createCard = async (data) => {
    try {
        const response = await axiosInstance.post(`/cards`, data);
        return response.data;
    } catch (error) {
        console.error('Error updating member status:', error);
        throw error;
    }
};

export const deleteCard = async (id) => {
    try {
        const response = await axiosInstance.delete(`/cards/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error updating member status:', error);
        throw error;
    }
};

