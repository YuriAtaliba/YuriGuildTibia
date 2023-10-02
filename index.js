const axios = require('axios');

const apiUrl = 'https://api.tibiadata.com/v3/guild/taseif';

async function fetchGuildData() {
  try {
    const response = await axios.get(apiUrl);
    const guildData = response.data.guild;

    // Verifica se guildData e guildData.members estão definidos
    if (guildData && guildData.members) {
      // Filtrar os personagens online
      const onlineMembers = guildData.members.filter(member => member.status === 'online');
      
      // Listar os personagens online
      onlineMembers.forEach(member => {
        const { name, level, vocation } = member;
        console.log(`Name: ${name}, Level: ${level}, Vocation: ${vocation}`);
      });
    } else {
      console.error('Os dados da guilda não estão disponíveis ou não estão no formato esperado.');
    }
  } catch (error) {
    console.error('Ocorreu um erro ao buscar os dados da guilda:', error);
  }
}

// Chama a função para buscar os dados da guilda
fetchGuildData();