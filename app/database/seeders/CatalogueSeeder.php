<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogues = [
            [
                'label' => [
                    'en' => 'Ebooks',
                    'fr' => 'Ebooks',
                    'ar' => 'الكتب الرقمية'
                ],
                'id_youscribe' => 59,
                'children' => [
                    [
                        'label' => [
                            'en' => 'Professional resources',
                            'fr' => 'Ressources professionnelles',
                            'ar' => 'الموارد المهنية'
                        ],
                        'id_youscribe' => 99,
                        'children' => [
                            [
                                'label' => [
                                    'en' => 'Stock market and finance',
                                    'fr' => 'Bourse et finance',
                                    'ar' => 'البورصة و عالم الأموال'
                                ],
                                'id_youscribe' => 100,
                            ],
                            [
                                'label' => [
                                    'en' => 'Accounting',
                                    'fr' => 'Comptabilité',
                                    'ar' => 'المحاسبة'
                                ],
                                'id_youscribe' => 101,
                            ],
                            [
                                'label' => [
                                    'en' => 'Business start-ups',
                                    'fr' => 'Création d\'entreprise',
                                    'ar' => 'كيفية تأسيس مقاولة'
                                ],
                                'id_youscribe' => 102,
                            ],
                            [
                                'label' => [
                                    'en' => 'Law and legal',
                                    'fr' => 'Droit juridique',
                                    'ar' => 'القانون'
                                ],
                                'id_youscribe' => 123,
                            ],
                            [
                                'label' => [
                                    'en' => 'Economy',
                                    'fr' => 'Economie',
                                    'ar' => 'الاقتصاد'
                                ],
                                'id_youscribe' => 179,
                            ],
                            [
                                'label' => [
                                    'en' => 'Professional efficiency',
                                    'fr' => 'Efficacité professionnelle',
                                    'ar' => 'الكفاءة المهنية'
                                ],
                                'id_youscribe' => 103,
                            ],
                            [
                                'label' => [
                                    'en' => 'Job and careers',
                                    'fr' => 'Emploi et carrières',
                                    'ar' => 'الوظائف والمهن'
                                ],
                                'id_youscribe' => 104,
                            ],
                            [
                                'label' => [
                                    'en' => 'Taxation',
                                    'fr' => 'Fiscalité',
                                    'ar' => 'التصريح الضريبي'
                                ],
                                'id_youscribe' => 124,
                            ],
                            [
                                'label' => [
                                    'en' => 'Operation and management',
                                    'fr' => 'Gestion et management',
                                    'ar' => 'علم الإدارة و التسيير'
                                ],
                                'id_youscribe' => 106,
                            ],
                            [
                                'label' => [
                                    'en' => 'IT systems',
                                    'fr' => 'Informatique',
                                    'ar' => 'المعلوميات'
                                ],
                                'id_youscribe' => 108,
                            ],
                            [
                                'label' => [
                                    'en' => 'Marketing and communication',
                                    'fr' => 'Marketing et communication',
                                    'ar' => 'التسويق والتواصل'
                                ],
                                'id_youscribe' => 107,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Santé et bien être',
                        'id_youscribe' => 70,
                        'children' => [
                            [
                                'label' => 'Alimentation et diététique',
                                'id_youscribe' => 71,
                            ],
                            [
                                'label' => 'Développement personnel',
                                'id_youscribe' => 72,
                            ],
                            [
                                'label' => 'Forme et détente',
                                'id_youscribe' => 73,
                            ],
                            [
                                'label' => 'Thérapies alternatives',
                                'id_youscribe' => 126,
                            ],
                            [
                                'label' => 'Beauté',
                                'id_youscribe' => 133,
                            ]
                        ]

                    ],
                    [
                        'label' => 'Education',
                        'id_youscribe' => 25,
                        'children' => [
                            [
                                'label' => 'Annales d\'examens et concours',
                                'id_youscribe' => 26,
                            ],
                            [
                                'label' => 'Dictionnaires',
                                'id_youscribe' => 177,
                            ],
                            [
                                'label' => 'Etudes supérieures',
                                'id_youscribe' => 143,
                            ],
                            [
                                'label' => 'Fiche de lecture',
                                'id_youscribe' => 29,
                            ],
                            [
                                'label' => 'Langues',
                                'id_youscribe' => 132,
                            ],
                            [
                                'label' => 'Manuels scolaire',
                                'id_youscribe' => 30,
                            ],
                            [
                                'label' => 'Maternelle et primaire',
                                'id_youscribe' => 31,
                            ],
                            [
                                'label' => 'Méthodologie',
                                'id_youscribe' => 145,
                            ],
                            [
                                'label' => 'Orientation scolaire',
                                'id_youscribe' => 32,
                            ],
                            [
                                'label' => 'Ressources pédagogiques',
                                'id_youscribe' => 34,
                            ],
                            [
                                'label' => 'Révisions',
                                'id_youscribe' => 26,
                            ],
                            [
                                'label' => 'Sciences de l\'éducation',
                                'id_youscribe' => 117,
                            ],
                            [
                                'label' => 'Travaux de classe',
                                'id_youscribe' => 36,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Littérature',
                        'id_youscribe' => 45,
                        'children' => [
                            [
                                'label' => 'Classiques',
                                'id_youscribe' => 48,
                            ],
                            [
                                'label' => 'Contes',
                                'id_youscribe' => 181,
                            ],
                            [
                                'label' => 'Etudes littéraires',
                                'id_youscribe' => 180,
                            ],
                            [
                                'label' => 'Littérature régionale',
                                'id_youscribe' => 193,
                            ],
                            [
                                'label' => 'Poésie',
                                'id_youscribe' => 52,
                            ],
                            [
                                'label' => 'Récits de voyage',
                                'id_youscribe' => 54,
                            ],
                            [
                                'label' => 'Romans et nouvelles',
                                'id_youscribe' => 55,
                            ],
                            [
                                'label' => 'Romans historiques',
                                'id_youscribe' => 56,
                            ],
                            [
                                'label' => 'Romans policiers, polars, thrillers',
                                'id_youscribe' => 53,
                            ],
                            [
                                'label' => 'SF et fantasy',
                                'id_youscribe' => 57,
                            ],
                            [
                                'label' => 'Témoignages et autobiographies',
                                'id_youscribe' => 46,
                            ],
                            [
                                'label' => 'Théâtre',
                                'id_youscribe' => 120,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Savoirs',
                        'id_youscribe' => 76,
                        'children' => [
                            [
                                'label' => 'Géographie',
                                'id_youscribe' => 148,
                            ],
                            [
                                'label' => 'Medecine',
                                'id_youscribe' => 81,
                            ],
                            [
                                'label' => 'Philosophie',
                                'id_youscribe' => 83,
                            ],
                            [
                                'label' => 'Religions et spiritualité',
                                'id_youscribe' => 85,
                            ],
                            [
                                'label' => 'Science de la nature',
                                'id_youscribe' => 82,
                            ],
                            [
                                'label' => 'Sciences formelles',
                                'id_youscribe' => 86,
                            ],
                            [
                                'label' => 'Techniques',
                                'id_youscribe' => 88,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Loisirs et hobbies',
                        'id_youscribe' => 58,
                        'children' => [
                            [
                                'label' => 'Animaux',
                                'id_youscribe' => 131,
                            ],
                            [
                                'label' => 'Bricolage et décoration',
                                'id_youscribe' => 60,
                            ],
                            [
                                'label' => 'Cuisine et vins',
                                'id_youscribe' => 61,
                            ],
                            [
                                'label' => 'Humour',
                                'id_youscribe' => 63,
                            ],
                            [
                                'label' => 'Jardinage',
                                'id_youscribe' => 65,
                            ],
                            [
                                'label' => 'Jeux',
                                'id_youscribe' => 66,
                            ],
                            [
                                'label' => 'Loisirs créatifs',
                                'id_youscribe' => 67,
                            ],
                            [
                                'label' => 'Moyens de transport',
                                'id_youscribe' => 59,
                            ],
                            [
                                'label' => 'Sports',
                                'id_youscribe' => 68,
                            ],
                            [
                                'label' => 'Voyages-guides',
                                'id_youscribe' => 69,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Art, musique et cinéma',
                        'id_youscribe' => 13,
                        'children' => [
                            [
                                'label' => 'Architecture et design',
                                'id_youscribe' => 14,
                            ],
                            [
                                'label' => 'Beaux-arts',
                                'id_youscribe' => 15,
                            ],
                            [
                                'label' => 'Cinéma',
                                'id_youscribe' => 19,
                            ],
                            [
                                'label' => 'Musique',
                                'id_youscribe' => 16,
                            ],
                            [
                                'label' => 'Partitions de musique variée',
                                'id_youscribe' => 140,
                            ],
                            [
                                'label' => 'Photographie',
                                'id_youscribe' => 18,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Jeunesse',
                        'id_youscribe' => 37,
                        'children' => [
                            [
                                'label' => 'Albums et romans',
                                'id_youscribe' => 39,
                            ],
                            [
                                'label' => 'Découverte',
                                'id_youscribe' => 41,
                            ],
                            [
                                'label' => 'Jeux et coloriages',
                                'id_youscribe' => 38,
                            ],
                            [
                                'label' => 'Premieres livres',
                                'id_youscribe' => 44,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Actualité',
                        'id_youscribe' => 4,
                        'children' => [
                            [
                                'label' => 'Actualité, événements',
                                'id_youscribe' => 6,
                            ],
                            [
                                'label' => 'Ecologie',
                                'id_youscribe' => 176,
                            ],
                            [
                                'label' => 'Essais',
                                'id_youscribe' => 8,
                            ],
                            [
                                'label' => 'Médias',
                                'id_youscribe' => 10,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Autres',
                        'id_youscribe' => 2024,
                    ],
                ],
            ],
            [
                'label' => 'Presse',
                'id_youscribe' => 67,
                'children' => [
                    [
                        'label' => 'Actualités',
                        'id_youscribe' => 144,
                        'children' => [
                            [
                                'label' => 'Hebdo',
                                'id_youscribe' => 247,
                            ],
                            [
                                'label' => 'Magazines',
                                'id_youscribe' => 248,
                            ],
                            [
                                'label' => 'Quotidiens',
                                'id_youscribe' => 252,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Culture & Médias',
                        'id_youscribe' => 238,
                        'children' => [
                            [
                                'label' => 'Arts',
                                'id_youscribe' => 240,
                            ],
                            [
                                'label' => 'Mode',
                                'id_youscribe' => 249,
                            ],
                            [
                                'label' => 'People & TV',
                                'id_youscribe' => 158,
                            ],
                            [
                                'label' => 'Culture',
                                'id_youscribe' => 203,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Lifestyle',
                        'id_youscribe' => 209,
                        'children' => [
                            [
                                'label' => 'Cuisine',
                                'id_youscribe' => 226,
                            ],
                            [
                                'label' => 'Déco',
                                'id_youscribe' => 225,
                            ],
                            [
                                'label' => 'Mode de vie',
                                'id_youscribe' => 250,
                            ],
                            [
                                'label' => 'Voyages et loisirs',
                                'id_youscribe' => 256,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Presse Internationale',
                        'id_youscribe' => 237,
                        'children' => [
                            [
                                'label' => 'Maroc',
                                'id_youscribe' => 195,
                            ],
                            [
                                'label' => 'Burkina-Faso',
                                'id_youscribe' => 186,
                            ],
                            [
                                'label' => 'Cameroun',
                                'id_youscribe' => 185,
                            ],
                            [
                                'label' => 'Côte d\'Ivoire',
                                'id_youscribe' => 184,
                            ],
                            [
                                'label' => 'Mali',
                                'id_youscribe' => 197,
                            ],
                            [
                                'label' => 'RDC',
                                'id_youscribe' => 196,
                            ],
                            [
                                'label' => 'Sénégal',
                                'id_youscribe' => 183,
                            ],
                            [
                                'label' => 'Tunisie',
                                'id_youscribe' => 199,
                            ],
                            [
                                'label' => 'UK',
                                'id_youscribe' => 254,
                            ],
                            [
                                'label' => 'US',
                                'id_youscribe' => 255,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Presse professionnelle',
                        'id_youscribe' => 211,
                        'children' => [
                            [
                                'label' => 'Actualités éco',
                                'id_youscribe' => 231,
                            ],
                            [
                                'label' => 'Économies internationales',
                                'id_youscribe' => 244,
                            ],
                            [
                                'label' => 'Presse spécialisé',
                                'id_youscribe' => 235,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Presse Jeunesse',
                        'id_youscribe' => 212,
                        'children' => [
                            [
                                'label' => 'Kids',
                                'id_youscribe' => 232,
                            ],
                            [
                                'label' => 'Ado',
                                'id_youscribe' => 233,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Pratique',
                        'id_youscribe' => 228,
                        'children' => [
                            [
                                'label' => 'Féminin',
                                'id_youscribe' => 152,
                            ],
                            [
                                'label' => 'Bien être',
                                'id_youscribe' => 227,
                            ],
                            [
                                'label' => 'Famille',
                                'id_youscribe' => 245,
                            ],
                            [
                                'label' => 'Consommation',
                                'id_youscribe' => 243,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Presse sportive',
                        'id_youscribe' => 236,
                        'children' => [
                            [
                                'label' => 'Football',
                                'id_youscribe' => 246,
                            ],
                            [
                                'label' => 'Auto / Moto',
                                'id_youscribe' => 241,
                            ],
                            [
                                'label' => 'Sport hippiques',
                                'id_youscribe' => 253,
                            ],
                            [
                                'label' => 'Autres sports',
                                'id_youscribe' => 242,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Archives',
                        'id_youscribe' => 182,
                        'children' => [
                            [
                                'label' => 'Archives Afrique',
                                'id_youscribe' => 190,
                            ],
                            [
                                'label' => 'Archives France',
                                'id_youscribe' => 189,
                            ]
                        ]
                    ]

                ],
            ],
            [
                'label' => 'Livres audio',
                'id_youscribe' => 69,
                'children' => [
                    [
                        'label' => 'Littérature',
                        'id_youscribe' => 45,
                        'children' => [
                            [
                                'label' => 'Classiques',
                                'id_youscribe' => 48,
                            ],
                            [
                                'label' => 'Contes',
                                'id_youscribe' => 181,
                            ],
                            [
                                'label' => 'Etudes littéraires',
                                'id_youscribe' => 180,
                            ],
                            [
                                'label' => 'Littérature régionale',
                                'id_youscribe' => 193,
                            ],
                            [
                                'label' => 'Poésie',
                                'id_youscribe' => 52,
                            ],
                            [
                                'label' => 'Récits de voyage',
                                'id_youscribe' => 54,
                            ],
                            [
                                'label' => 'Romans et nouvelles',
                                'id_youscribe' => 55,
                            ],
                            [
                                'label' => 'Romans historiques',
                                'id_youscribe' => 56,
                            ],
                            [
                                'label' => 'Romans policiers, polars, thrillers',
                                'id_youscribe' => 53,
                            ],
                            [
                                'label' => 'SF et fantasy',
                                'id_youscribe' => 57,
                            ],
                            [
                                'label' => 'Témoignages et autobiographies',
                                'id_youscribe' => 46,
                            ],
                            [
                                'label' => 'Théâtre',
                                'id_youscribe' => 120,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Jeunesse',
                        'id_youscribe' => 37,
                        'children' => [
                            [
                                'label' => 'Albums et romans',
                                'id_youscribe' => 39,
                            ],
                            [
                                'label' => 'Découverte',
                                'id_youscribe' => 41,
                            ],
                            [
                                'label' => 'Jeux et coloriages',
                                'id_youscribe' => 38,
                            ],
                            [
                                'label' => 'Premieres livres',
                                'id_youscribe' => 44,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Ressources professionnelles',
                        'id_youscribe' => 99,
                        'children' => [
                            [
                                'label' => 'Analyses et études sectorielles',
                                'id_youscribe' => 125,
                            ],
                            [
                                'label' => 'Bourse et finance',
                                'id_youscribe' => 100,
                            ],
                            [
                                'label' => 'Comptabilité',
                                'id_youscribe' => 101,
                            ],
                            [
                                'label' => 'Création d\'entreprise',
                                'id_youscribe' => 102,
                            ],
                            [
                                'label' => 'Droit juridique',
                                'id_youscribe' => 123,
                            ],
                            [
                                'label' => 'Economie',
                                'id_youscribe' => 179,
                            ],
                            [
                                'label' => 'Efficacité professionnelle',
                                'id_youscribe' => 103,
                            ],
                            [
                                'label' => 'Emploi et carrières',
                                'id_youscribe' => 104,
                            ],
                            [
                                'label' => 'Fiscalité',
                                'id_youscribe' => 124,
                            ],
                            [
                                'label' => 'Gestion et management',
                                'id_youscribe' => 106,
                            ],
                            [
                                'label' => 'Informatique',
                                'id_youscribe' => 108,
                            ],
                            [
                                'label' => 'Marketing et communication',
                                'id_youscribe' => 107,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Santé et bien être',
                        'id_youscribe' => 70,
                        'children' => [
                            [
                                'label' => 'Alimentation et diététique',
                                'id_youscribe' => 71,
                            ],
                            [
                                'label' => 'Développement personnel',
                                'id_youscribe' => 72,
                            ],
                            [
                                'label' => 'Forme et détente',
                                'id_youscribe' => 73,
                            ],
                            [
                                'label' => 'Thérapies alternatives',
                                'id_youscribe' => 126,
                            ],
                            [
                                'label' => 'Beauté',
                                'id_youscribe' => 133,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Savoirs',
                        'id_youscribe' => 76,
                        'children' => [
                            [
                                'label' => 'Géographie',
                                'id_youscribe' => 148,
                            ],
                            [
                                'label' => 'Medecine',
                                'id_youscribe' => 81,
                            ],
                            [
                                'label' => 'Philosophie',
                                'id_youscribe' => 83,
                            ],
                            [
                                'label' => 'Religions et spiritualité',
                                'id_youscribe' => 85,
                            ],
                            [
                                'label' => 'Science de la nature',
                                'id_youscribe' => 82,
                            ],
                            [
                                'label' => 'Sciences formelles',
                                'id_youscribe' => 86,
                            ],
                            [
                                'label' => 'Techniques',
                                'id_youscribe' => 88,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Education',
                        'id_youscribe' => 25,
                        'children' => [
                            [
                                'label' => 'Annales d\'examens et concours',
                                'id_youscribe' => 26,
                            ],
                            [
                                'label' => 'Dictionnaires',
                                'id_youscribe' => 177,
                            ],
                            [
                                'label' => 'Etudes supérieures',
                                'id_youscribe' => 143,
                            ],
                            [
                                'label' => 'Fiche de lecture',
                                'id_youscribe' => 29,
                            ],
                            [
                                'label' => 'Langues',
                                'id_youscribe' => 132,
                            ],
                            [
                                'label' => 'Manuels scolaire',
                                'id_youscribe' => 30,
                            ],
                            [
                                'label' => 'Maternelle et primaire',
                                'id_youscribe' => 31,
                            ],
                            [
                                'label' => 'Méthodologie',
                                'id_youscribe' => 145,
                            ],
                            [
                                'label' => 'Orientation scolaire',
                                'id_youscribe' => 32,
                            ],
                            [
                                'label' => 'Ressources pédagogiques',
                                'id_youscribe' => 34,
                            ],
                            [
                                'label' => 'Révisions',
                                'id_youscribe' => 26,
                            ],
                            [
                                'label' => 'Sciences de l\'éducation',
                                'id_youscribe' => 117,
                            ],
                            [
                                'label' => 'Travaux de classe',
                                'id_youscribe' => 36,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Loisirs et hobbies',
                        'id_youscribe' => 58,
                        'children' => [
                            [
                                'label' => 'Animaux',
                                'id_youscribe' => 131,
                            ],
                            [
                                'label' => 'Bricolage et décoration',
                                'id_youscribe' => 60,
                            ],
                            [
                                'label' => 'Cuisine et vins',
                                'id_youscribe' => 61,
                            ],
                            [
                                'label' => 'Humour',
                                'id_youscribe' => 63,
                            ],
                            [
                                'label' => 'Jardinage',
                                'id_youscribe' => 65,
                            ],
                            [
                                'label' => 'Jeux',
                                'id_youscribe' => 66,
                            ],
                            [
                                'label' => 'Loisirs créatifs',
                                'id_youscribe' => 67,
                            ],
                            [
                                'label' => 'Moyens de transport',
                                'id_youscribe' => 59,
                            ],
                            [
                                'label' => 'Sports',
                                'id_youscribe' => 68,
                            ],
                            [
                                'label' => 'Voyages-guides',
                                'id_youscribe' => 69,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Art, musique et cinéma',
                        'id_youscribe' => 13,
                        'children' => [
                            [
                                'label' => 'Architecture et design',
                                'id_youscribe' => 14,
                            ],
                            [
                                'label' => 'Beaux-arts',
                                'id_youscribe' => 15,
                            ],
                            [
                                'label' => 'Cinéma',
                                'id_youscribe' => 19,
                            ],
                            [
                                'label' => 'Musique',
                                'id_youscribe' => 16,
                            ],
                            [
                                'label' => 'Partitions de musique variée',
                                'id_youscribe' => 140,
                            ],
                            [
                                'label' => 'Photographie',
                                'id_youscribe' => 18,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Actualité et débat de société',
                        'id_youscribe' => 4,
                        'children' => [
                            [
                                'label' => 'Actualité, événements',
                                'id_youscribe' => 6,
                            ],
                            [
                                'label' => 'Ecologie',
                                'id_youscribe' => 176,
                            ],
                            [
                                'label' => 'Essais',
                                'id_youscribe' => 8,
                            ],
                            [
                                'label' => 'Médias',
                                'id_youscribe' => 10,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Autres',
                        'id_youscribe' => 2024,
                    ],
                ],
            ],
            [
                'label' => 'Bandes dessinées',
                'id_youscribe' => 60,
                'children' => [
                    [
                        'label' => 'BD Humoristique',
                        'id_youscribe' => 162,
                    ],
                    [
                        'label' => 'Jeunesse',
                        'id_youscribe' => 37,
                        'children' => [
                            [
                                'label' => 'Albums et romans',
                                'id_youscribe' => 39,
                            ],
                            [
                                'label' => 'Découverte',
                                'id_youscribe' => 41,
                            ],
                            [
                                'label' => 'Jeux et coloriages',
                                'id_youscribe' => 38,
                            ],
                            [
                                'label' => 'Premieres livres',
                                'id_youscribe' => 44,
                            ],
                        ]
                    ],
                    [
                        'label' => 'Actions et aventures',
                        'id_youscribe' => 159,
                        'children' => [
                            [
                                'label' => 'Aventure',
                                'id_youscribe' => 161,
                            ],
                            [
                                'label' => 'Policiers & thrillers',
                                'id_youscribe' => 160,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Science-fiction et Fantasy',
                        'id_youscribe' => 163,
                        'children' => [
                            [
                                'label' => 'Fantastiques',
                                'id_youscribe' => 164,
                            ],
                            [
                                'label' => 'Medieval & Heroic Fantasy',
                                'id_youscribe' => 165,
                            ],
                            [
                                'label' => 'Science-fiction',
                                'id_youscribe' => 166,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Mangas',
                        'id_youscribe' => 24,
                    ],
                    [
                        'label' => 'Société',
                        'id_youscribe' => 167,
                        'children' => [
                            [
                                'label' => 'Documentaire',
                                'id_youscribe' => 170,
                            ],
                            [
                                'label' => 'Fiction',
                                'id_youscribe' => 169,
                            ],
                            [
                                'label' => 'Historique',
                                'id_youscribe' => 168,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Comics',
                        'id_youscribe' => 114,
                    ],
                    [
                        'label' => 'Autres',
                        'id_youscribe' => 2024,
                    ],
                ],
            ],
        ];

        foreach ($catalogues as $catalogue) {
            Catalogue::create($catalogue);
        }
    }
}
