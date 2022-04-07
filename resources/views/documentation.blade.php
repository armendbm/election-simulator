<x-app-layout>
    <br>
    <h2>
        {{ __('Documentation') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h4 class="mt-3">Overview</h4>
                    <p style="text-indent: 5rem">
                        Civics is a complex topic fundamental to performing our duties as a member of our society. Learning about voting systems can be exhaustive, and people often do not have the time to simulate elections on their own. Since elections are often taught through hypotheticals and lectures, we seek to create a hands-on tool that allows users to manipulate, test, and better understand different systems of elections.
                    </p>
                    <p style="text-indent: 5rem">
                        There is no educational tool on the market which allows you to visually compare how different voting systems work, nor is there an effective tool to demonstrate how different  systems, like the Electoral College, works. For the remainder of this report, we will provide an overview of the development process, schedule, risks, features, and a business case to showcase the value of our product.
                    </p>
                    <br>
                    <h4 class="mt-3">FPTP</h4>
                    <p style="text-indent: 5rem">
                        Standing for "first-past-the-post", the FPTP electoral
                        system is the quintessential electoral system in which the
                        candidate with the plurality of votes is the winner. That
                        is just a fancy way of saying that whoever has the most votes
                        wins, end of story.
                    </p>
                    <p style="text-indent: 5rem">
                        FPTP is also known as single-member plurality voting (SMP) or
                        choose-one voting.
                        It is the primary electoral system in much of the English-speaking
                        world, including Canada, India, the United Kingdom,
                        and, most notably, the United States.
                    </p>
                    <br>
                    <h4 class="mt-3">IRV</h4>
                    <p style="text-indent: 5rem">
                        Standing for "instant-runoff voting", the IRV electoral
                        system is a form of ranked preferential voting in which voters
                        rank the candidates from their most to least preferred. There
                        will be rounds in which the candidates with the fewest
                        first-perference votes will be eliminated, and each vote that
                        had the eliminated candidate as the first preference will
                        then be counted for the vote's candidate with the next
                        highest preference. This cycle continues until the desired number of candidates
                        remain whom will then be declared the winners.
                    </p>
                    <p style="text-indent: 5rem">
                        IRV is sometimes referred to as preferential voting,
                        alternative voting, ranked-choice voting (United States), or
                        single transferable voting (New Zealad). It is practiced
                        nationwide in Australia and Canada, and has been practiced
                        on local levels in the United States.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
