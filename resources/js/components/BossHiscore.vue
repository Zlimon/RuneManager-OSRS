<template>
    <div>
        <div class="float-left mt-3 ml-3">
            <h1 class="text-left">{{ meta.alias }}</h1>

            <span>Total Kills: <strong>{{ meta.total_kills }}</strong></span>
            <br>
            <span>Average Kills: <strong>{{ meta.average_total_kills }}</strong></span>
        </div>

        <table>
            <tr>
                <th>Rank</th>
                <th>Account</th>
                <th>Kill Count</th>
                <th>Hiscore Rank</th>
                <th>Collection Log</th>
                <th>Obtained</th>
            </tr>
            <tr v-for="(hiscore, index) in hiscores">
                <td>{{ index + 1 }}</td>
                <td><a :href="'/account/' + hiscore.account.username">{{ hiscore.account.username }}</a></td>
                <td>{{ hiscore.kill_count }}</td>
                <td>{{ hiscore.rank }}</td>
                <td>
                    <a :data-target="$idRef(index)" class="btn background-world-map" data-toggle="modal">
                        <img :title="'Click here to see collection log for ' + meta.alias"
                             alt="Collection log item icon"
                             src="https://www.osrsbox.com/osrsbox-db/items-icons/22711.png">
                    </a>
                </td>
                <td>
                    <div v-if="(hiscore.obtained !== null ? hiscore.obtained : 0) === total">
                        <span class="runescape-success">
                            {{ (hiscore.obtained !== null ? hiscore.obtained : 0) }} / {{ total }}
                        </span>
                    </div>
                    <div v-else-if="hiscore.obtained > 0">
                        <span class="runescape-progress">{{ hiscore.obtained }} / {{ total }}</span>
                    </div>
                    <div v-else>
                        <span class="runescape-danger">
                            {{ (hiscore.obtained !== null ? hiscore.obtained : 0) }} / {{ total }}
                        </span>
                    </div>
                </td>
                <div :id="$id(index)" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-body background-dialog-iron-rivets text-light">
                                <button class="btn btn-lg button-window-close float-right"
                                        data-dismiss="modal"></button>
                                <h1>{{ hiscore.account.username }}</h1>
                                <div class="d-flex flex-row flex-wrap justify-content-center">
                                    <div v-for="(count, item) in hiscore.log"
                                         class="collection-log-item rounded background-world-map bg-dark p-4">
                                        <div v-if="count === 1">
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + meta.boss + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon">
                                        </div>
                                        <div v-else-if="count > 0">
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + meta.boss + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon">
                                            <span class="collection-log-item-counter runescape-progress">
                                                {{ count }}
                                            </span>
                                        </div>
                                        <div v-else>
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + meta.boss + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon faded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        boss: {type: String, required: true}
    },

    data() {
        return {
            hiscores: {},
            meta: {},
            total: 0
        }
    },

    mounted() {
        axios
            .get('/api/hiscore/boss/' + this.boss)
            .then((response) => {
                this.hiscores = response.data.data;
                this.meta = response.data.meta;
                this.total = Object.keys(response.data.data[0].log).length
            })
            .catch(error => (console.log(error)))
    },

    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    }
}
</script>
