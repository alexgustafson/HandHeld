//
//  ComputerMusuemStartView.m
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/16/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "ComputerMusuemStartView.h"

@interface ComputerMusuemStartView ()

@end

@implementation ComputerMusuemStartView
@synthesize linkedArticleID, coverButton, coverImageView, article;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

-(void)initializeWithArticle:(HHArticleModel *)a
{
    self.article = a;
    [self setLinkedArticleID:[[article data] valueForKey:@"70"]];
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    NSString* fileName = [[article data] valueForKey:@"69"];
    NSArray *pathArr = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *folder = [pathArr objectAtIndex:0];
    NSString *filePath = [folder stringByAppendingPathComponent:fileName];
    NSLog(filePath);
    [[self coverImageView] setImage:[UIImage imageWithContentsOfFile:filePath]];


}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)imageButtonClicked:(id)sender
{
    
    NSMutableDictionary *action = [[NSMutableDictionary alloc] init];
    [action setObject:@"go to article" forKey:@"action"];
    [action setObject:[self linkedArticleID] forKey:@"article"];

    
    [[NSNotificationCenter defaultCenter] postNotificationName:@"HHAction" object:self userInfo:action];
    
}


@end
