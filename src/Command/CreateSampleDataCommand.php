<?php

namespace App\Command;

use App\Entity\ContactFormUrlPost;
use App\Entity\Enum\LanguageEnum;
use App\Entity\GeneralData;
use App\Entity\GlobalTags;
use App\Entity\PageSeo;
use App\Repository\ContactFormUrlPostRepository;
use App\Repository\GeneralDataRepository;
use App\Repository\GlobalTagsRepository;
use App\Repository\PageSeoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-sample-data',
    description: 'Criar dados inciais para o sistema',
)]
class CreateSampleDataCommand extends Command
{
    public function __construct(
        private GeneralDataRepository $generalDataRepository,
        private PageSeoRepository $seoRepository,
        private GlobalTagsRepository $globalTagsRepository,
        private ContactFormUrlPostRepository $contactFormUrlPostRepository,
        private EntityManagerInterface $em,
        private readonly PageSeoRepository $pageSeoRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        foreach (LanguageEnum::getOptions() as $index => $option)
        {
            $pageSeo = $this->pageSeoRepository->findBy(['language' => $option]);
            if ($pageSeo)
            {
                $io->writeln('Page Seo em '.$index.' <comment> já existe</comment>');
            } else
            {
                $io->writeln('Page Seo em '.$index.' <info>criada</info>');
                $pageSeo = new PageSeo();
                $pageSeo->setHomePageTitle("Titulo da pagina");
                $pageSeo->setHomePageDescription("Descricao da pagina");
                $pageSeo->setAboutUsPageTitle("Titulo da pagina");
                $pageSeo->setAboutUsPageDescription("Descricao da pagina ");
                $pageSeo->setProductListingPageTitle("Titulo da pagina");
                $pageSeo->setProductListingPageDescription("Descricao da pagina ");
                $pageSeo->setNewsListingPageTitle("Titulo da pagina");
                $pageSeo->setNewsListingPageDescription("Descricao da pagina ");
                $pageSeo->setServiceListingPageTitle("Titulo da pagina");
                $pageSeo->setServiceListingPageDescription("Descricao da pagina ");
                $pageSeo->setFinancingListPageTitle("Titulo da pagina");
                $pageSeo->setFinanceListPageDescription("Descricao da pagina ");
                $pageSeo->setVideoListingPageTitle("Titulo da pagina");
                $pageSeo->setVideoListingPageDescription("Descricao da pagina ");
                $pageSeo->setAboutUsPageTitle("Titulo da pagina");
                $pageSeo->setLanguage($option);
                $this->em->persist($pageSeo);
                $this->em->flush();
            }
        }

        $generalData = $this->generalDataRepository->find(1);
        if ($generalData) {
            $io->writeln('General data <comment> já existe</comment>');
        } else {
            $io->writeln('General data <comment>criada</comment>');
            $generalData = new GeneralData();
            $generalData->setEmail("email@dominio.com.br");
            $generalData->setAddress("Rua X, 123");
            $generalData->setPhone("(11) 2243-9067");

            $this->em->persist($generalData);
            $this->em->flush();
        }

        $globalTags = $this->globalTagsRepository->findAll();
        if ($globalTags)
        {
            $io->writeln('Global Tags <comment> já existe</comment>');
        }
        else
        {
            $io->writeln('Global Tags <comment>criada</comment>');
            $globalTags = new GlobalTags();
            $globalTags->setGa4('GA4');
            $globalTags->setPixelMetaAds('Meta pixel');
            $globalTags->setTagsGoogleAds('Google Ads');

            $this->em->persist($globalTags);
            $this->em->flush();
        }

        $contactForm = $this->contactFormUrlPostRepository->findAll();
        if ($contactForm)
        {
            $io->writeln('URL de postagem <comment> já existe</comment>');
        }
        else
        {
            $io->writeln('URL de postagem <comment>criado</comment>');
            $contactForm = new ContactFormUrlPost();
            $contactForm->setUrl('https://teste.com.br');

            $this->em->persist($contactForm);
            $this->em->flush();
        }



        $io->success('Dados injetados com sucesso!');

        return Command::SUCCESS;
    }
}
